<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\SignatureRequest;
use App\Models\Juridique\Signature;
use App\Models\Juridique\Document;
use App\Models\User;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function index()
    {
        $signatures = Signature::with('user', 'document')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.signatures.index', compact('signatures'));
    }

    public function enAttente()
    {
        $signatures = Signature::with('user', 'document')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return view('back.juridique.signatures.en-attente', compact('signatures'));
    }

    public function signees()
    {
        $signatures = Signature::with('user', 'document')
            ->where('statut', 'signe')
            ->orderBy('date_signature', 'desc')
            ->paginate(15);

        return view('back.juridique.signatures.signees', compact('signatures'));
    }

    public function create()
    {
        $documents = Document::where('statut', 'en_attente')
            ->where('type_document_id', function($q) {
                $q->select('id')->from('types_documents')->where('necessite_signature', true);
            })
            ->get();

        $utilisateurs = User::orderBy('name')->get();

        return view('back.juridique.signatures.create', compact('documents', 'utilisateurs'));
    }

    public function store(SignatureRequest $request)
    {
        $data = $request->validated();

        $signature = Signature::create($data);

        // Mettre à jour le document si c'est la première signature
        $document = Document::find($data['document_id']);
        if ($document->statut === 'en_attente') {
            $document->update(['statut' => 'signature_attendue']);
        }

        return redirect()
            ->route('back.juridique.signatures.show', $signature)
            ->with('success', 'Signature ajoutée avec succès.');
    }

    public function show(Signature $signature)
    {
        $signature->load(['user', 'document.typeDocument']);

        return view('back.juridique.signatures.show', compact('signature'));
    }

    public function edit(Signature $signature)
    {
        $documents = Document::where('statut', 'signature_attendue')->get();
        $utilisateurs = User::orderBy('name')->get();

        return view('back.juridique.signatures.edit', compact('signature', 'documents', 'utilisateurs'));
    }

    public function update(SignatureRequest $request, Signature $signature)
    {
        $signature->update($request->validated());

        return redirect()
            ->route('back.juridique.signatures.show', $signature)
            ->with('success', 'Signature mise à jour avec succès.');
    }

    public function destroy(Signature $signature)
    {
        $signature->delete();

        return redirect()
            ->route('back.juridique.signatures.index')
            ->with('success', 'Signature supprimée avec succès.');
    }

    public function reordonner(Request $request)
    {
        $request->validate([
            'signatures' => 'required|array',
            'signatures.*.id' => 'exists:signatures,id',
            'signatures.*.ordre' => 'integer|min:0'
        ]);

        foreach ($request->signatures as $signatureData) {
            Signature::where('id', $signatureData['id'])->update(['ordre' => $signatureData['ordre']]);
        }

        return response()->json(['success' => true]);
    }

    public validerDocument(Signature $signature)
    {
        $document = $signature->document;

        // Vérifier que toutes les signatures sont faites
        $signaturesEnAttente = $document->signatures()
            ->where('statut', 'en_attente')
            ->count();

        if ($signaturesEnAttente === 0) {
            $document->update([
                'statut' => 'signe',
                'date_signature' => now()
            ]);

            // Envoyer des notifications
            $this->notifierValidation($document);
        }

        return redirect()
            ->route('back.juridique.documents.show', $document)
            ->with('success', 'Toutes les signatures sont complétées.');
    }

    private function notifierValidation(Document $document)
    {
        // Notification aux signataires
        foreach ($document->signatures as $signature) {
            \App\Models\Juridique\NotificationJuridique::create([
                'user_id' => $signature->user_id,
                'type' => 'document_signe',
                'message' => "Le document '{$document->titre}' a été complètement signé.",
                'data' => ['document_id' => $document->id]
            ]);
        }

        // Notification au créateur
        \App\Models\Juridique\NotificationJuridique::create([
            'user_id' => $document->cree_par,
            'type' => 'document_valide',
            'message' => "Le document '{$document->titre}' a été signé par toutes les parties.",
            'data' => ['document_id' => $document->id]
        ]);
    }
}
