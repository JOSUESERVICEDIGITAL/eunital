<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\SignatureElectroniqueRequest;
use App\Models\Juridique\Signature;
use App\Models\Juridique\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SignatureElectroniqueController extends Controller
{
    public function index()
    {
        $signatures = Signature::with('user', 'document')
            ->where('user_id', auth()->id())
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('back.juridique.signatures.index', compact('signatures'));
    }

    public function show(Signature $signature)
    {
        $signature->load(['user', 'document.typeDocument', 'document.createur']);

        // Vérifier que l'utilisateur est bien le signataire
        if ($signature->user_id !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à signer ce document.');
        }

        return view('back.juridique.signatures.show', compact('signature'));
    }

    public function signer(SignatureElectroniqueRequest $request, Signature $signature)
    {
        // Vérifier que l'utilisateur est bien le signataire
        if ($signature->user_id !== auth()->id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        // Vérifier que la signature est en attente
        if ($signature->statut !== 'en_attente') {
            return response()->json(['error' => 'Cette signature n\'est plus valide'], 400);
        }

        // Enregistrer la signature
        $signature->signer($request->signature_base64, $request->ip());

        // Ajouter à l'historique
        $this->ajouterHistorique($signature);

        return response()->json([
            'success' => true,
            'message' => 'Signature enregistrée avec succès.',
            'redirect' => route('back.juridique.signatures.recap', $signature)
        ]);
    }

    public function recap(Signature $signature)
    {
        $signature->load(['user', 'document.typeDocument', 'document.contrat']);

        return view('back.juridique.signatures.recap', compact('signature'));
    }

    public function refuser(Request $request, Signature $signature)
    {
        $request->validate([
            'motif' => 'required|string|min:10'
        ]);

        $signature->update([
            'statut' => 'refuse',
            'commentaire' => $request->motif
        ]);

        return redirect()
            ->route('back.juridique.signatures.index')
            ->with('success', 'Signature refusée.');
    }

    public function envoyer(Signature $signature)
    {
        // Générer un token unique
        $token = Str::random(64);

        // Créer le lien de signature
        $lien = route('public.signature', ['token' => $token]);

        // Envoyer l'email
        \Mail::to($signature->user->email)->send(new \App\Mail\SignatureRequest($signature, $lien));

        return redirect()
            ->back()
            ->with('success', 'Demande de signature envoyée par email.');
    }

    public function verifierToken($token)
    {
        $signature = Signature::whereHas('utilisateursSignataires', function($q) use ($token) {
            $q->where('token', $token);
        })->first();

        if (!$signature) {
            abort(404, 'Lien de signature invalide.');
        }

        if ($signature->utilisateursSignataires->first()->pivot->expire_le < now()) {
            abort(410, 'Ce lien a expiré.');
        }

        return view('back.juridique.signatures.public', compact('signature', 'token'));
    }

    public function signerPublic(Request $request, $token)
    {
        $request->validate([
            'signature_base64' => 'required|string'
        ]);

        $signatureRelation = \DB::table('signature_utilisateur')
            ->where('token', $token)
            ->first();

        if (!$signatureRelation) {
            return response()->json(['error' => 'Lien invalide'], 404);
        }

        if ($signatureRelation->expire_le < now()) {
            return response()->json(['error' => 'Lien expiré'], 410);
        }

        $signature = Signature::find($signatureRelation->signature_id);

        $signature->update([
            'signature_base64' => $request->signature_base64,
            'date_signature' => now(),
            'statut' => 'signe',
            'adresse_ip' => $request->ip()
        ]);

        \DB::table('signature_utilisateur')
            ->where('token', $token)
            ->update([
                'statut' => 'valide',
                'signe_le' => now()
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Signature enregistrée avec succès.'
        ]);
    }

    private function ajouterHistorique(Signature $signature)
    {
        $historique = $signature->document->metadatas['historique'] ?? [];

        $historique[] = [
            'date' => now(),
            'action' => 'Signature',
            'utilisateur' => auth()->user()->name,
            'details' => "Signature {$signature->type_signataire_label} apposée"
        ];

        $signature->document->update([
            'metadatas' => array_merge($signature->document->metadatas ?? [], ['historique' => $historique])
        ]);
    }
}
