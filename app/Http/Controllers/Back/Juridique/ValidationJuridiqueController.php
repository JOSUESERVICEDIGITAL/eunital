<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Models\Juridique\Document;
use App\Models\Juridique\Contrat;
use App\Models\Juridique\Engagement;
use App\Models\Juridique\Signature;
use Illuminate\Http\Request;

class ValidationJuridiqueController extends Controller
{
    public function index()
    {
        $aValider = [
            'documents' => Document::where('statut', 'en_attente')->count(),
            'contrats' => Contrat::where('date_fin', '<', now()->addDays(30))->where('date_fin', '>', now())->count(),
            'signatures' => Signature::where('statut', 'en_attente')->count(),
            'engagements' => Engagement::where('date_fin', '<', now()->addDays(30))->where('date_fin', '>', now())->count()
        ];

        $documentsEnAttente = Document::with('typeDocument', 'createur')
            ->where('statut', 'en_attente')
            ->orderBy('created_at')
            ->limit(10)
            ->get();

        $signaturesEnAttente = Signature::with('user', 'document')
            ->where('statut', 'en_attente')
            ->orderBy('created_at')
            ->limit(10)
            ->get();

        $contratsExpirants = Contrat::with('document')
            ->whereBetween('date_fin', [now(), now()->addDays(30)])
            ->orderBy('date_fin')
            ->limit(10)
            ->get();

        return view('back.juridique.validation.index', compact(
            'aValider', 'documentsEnAttente', 'signaturesEnAttente', 'contratsExpirants'
        ));
    }

    public function validerDocument(Request $request, Document $document)
    {
        $request->validate([
            'commentaire' => 'nullable|string'
        ]);

        $document->update([
            'statut' => 'valide',
            'valide_par' => auth()->id(),
            'valide_le' => now()
        ]);

        // Ajouter à l'historique
        $historique = $document->metadatas['historique'] ?? [];
        $historique[] = [
            'date' => now(),
            'action' => 'Validation juridique',
            'utilisateur' => auth()->user()->name,
            'commentaire' => $request->commentaire
        ];
        $document->metadatas = array_merge($document->metadatas ?? [], ['historique' => $historique]);
        $document->save();

        return redirect()
            ->back()
            ->with('success', 'Document validé avec succès.');
    }

    public function rejeterDocument(Request $request, Document $document)
    {
        $request->validate([
            'motif' => 'required|string|min:10'
        ]);

        $document->update([
            'statut' => 'brouillon',
            'metadatas' => array_merge($document->metadatas ?? [], [
                'rejet' => [
                    'date' => now(),
                    'motif' => $request->motif,
                    'utilisateur' => auth()->user()->name
                ]
            ])
        ]);

        return redirect()
            ->back()
            ->with('warning', 'Document rejeté. Motif: ' . $request->motif);
    }

    public function validerSignature(Request $request, Signature $signature)
    {
        $request->validate([
            'commentaire' => 'nullable|string'
        ]);

        $signature->update([
            'statut' => 'signe',
            'date_signature' => now(),
            'commentaire' => $request->commentaire
        ]);

        // Vérifier si toutes les signatures sont complétées
        $document = $signature->document;
        $signaturesRestantes = $document->signatures()
            ->where('statut', 'en_attente')
            ->count();

        if ($signaturesRestantes === 0) {
            $document->update([
                'statut' => 'signe',
                'date_signature' => now()
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Signature validée avec succès.');
    }

    public function rejeterSignature(Request $request, Signature $signature)
    {
        $request->validate([
            'motif' => 'required|string|min:10'
        ]);

        $signature->update([
            'statut' => 'refuse',
            'commentaire' => $request->motif
        ]);

        return redirect()
            ->back()
            ->with('warning', 'Signature rejetée. Motif: ' . $request->motif);
    }

    public function verifierConformite(Request $request, Document $document)
    {
        $request->validate([
            'type_controle' => 'required|in:legal,formel,complet'
        ]);

        $resultats = $this->verifierDocument($document, $request->type_controle);

        return response()->json([
            'success' => true,
            'resultats' => $resultats
        ]);
    }

    public function batchValidation(Request $request)
    {
        $request->validate([
            'documents' => 'required|array',
            'documents.*' => 'exists:documents,id',
            'action' => 'required|in:valider,rejeter'
        ]);

        $count = 0;
        foreach ($request->documents as $documentId) {
            $document = Document::find($documentId);
            if ($document && $document->statut === 'en_attente') {
                if ($request->action === 'valider') {
                    $document->update([
                        'statut' => 'valide',
                        'valide_par' => auth()->id(),
                        'valide_le' => now()
                    ]);
                } else {
                    $document->update(['statut' => 'brouillon']);
                }
                $count++;
            }
        }

        return redirect()
            ->back()
            ->with('success', "{$count} document(s) traités avec succès.");
    }

    public function rapports()
    {
        $stats = [
            'documents_valides' => Document::where('statut', 'valide')->count(),
            'documents_en_attente' => Document::where('statut', 'en_attente')->count(),
            'signatures_realisees' => Signature::where('statut', 'signe')->count(),
            'signatures_attendues' => Signature::where('statut', 'en_attente')->count(),
            'taux_validation' => $this->calculerTauxValidation()
        ];

        $evolution = Document::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('back.juridique.validation.rapports', compact('stats', 'evolution'));
    }

    private function verifierDocument(Document $document, $type)
    {
        $resultats = [];

        // Vérification légale
        if ($type === 'legal' || $type === 'complet') {
            $resultats['legal'] = [
                'conforme' => $this->verifierLegalite($document),
                'details' => $this->getDetailsLegalite($document)
            ];
        }

        // Vérification formelle
        if ($type === 'formel' || $type === 'complet') {
            $resultats['formel'] = [
                'conforme' => $this->verifierFormel($document),
                'details' => $this->getDetailsFormel($document)
            ];
        }

        return $resultats;
    }

    private function verifierLegalite(Document $document)
    {
        // Logique de vérification légale
        return true;
    }

    private function verifierFormel(Document $document)
    {
        $champsRequis = $document->modeleDocument?->champs_requis ?? [];
        $variablesUtilisees = array_keys($document->variables_utilisees ?? []);

        foreach ($champsRequis as $champ) {
            if (!in_array($champ, $variablesUtilisees)) {
                return false;
            }
        }

        return true;
    }

    private function getDetailsLegalite(Document $document)
    {
        return [
            'mentions_legales' => $this->verifierMentionsLegales($document),
            'conformite_rgpd' => $this->verifierConformiteRgpd($document),
            'validite_juridique' => true
        ];
    }

    private function getDetailsFormel(Document $document)
    {
        $champsRequis = $document->modeleDocument?->champs_requis ?? [];
        $variablesUtilisees = array_keys($document->variables_utilisees ?? []);

        return [
            'champs_requis' => $champsRequis,
            'champs_remplis' => $variablesUtilisees,
            'champs_manquants' => array_diff($champsRequis, $variablesUtilisees)
        ];
    }

    private function verifierMentionsLegales(Document $document)
    {
        return true;
    }

    private function verifierConformiteRgpd(Document $document)
    {
        return true;
    }

    private function calculerTauxValidation()
    {
        $total = Document::count();
        $valides = Document::where('statut', 'valide')->count();

        return $total > 0 ? round(($valides / $total) * 100, 2) : 0;
    }
}
