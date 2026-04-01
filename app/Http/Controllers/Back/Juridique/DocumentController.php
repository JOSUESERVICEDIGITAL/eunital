<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\DocumentRequest;
use App\Models\Juridique\Document;
use App\Models\Juridique\TypeDocument;
use App\Models\Juridique\ModeleDocument;
use App\Models\User;
use App\Models\Juridique\Entreprise;
use App\Services\Juridique\DocumentGenerationService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $documentGenerationService;

    public function __construct(DocumentGenerationService $documentGenerationService)
    {
        $this->documentGenerationService = $documentGenerationService;
    }

    public function index()
    {
        $documents = Document::with('typeDocument', 'createur')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.documents.index', compact('documents'));
    }

    public function brouillons()
    {
        $documents = Document::with('typeDocument', 'createur')
            ->where('statut', 'brouillon')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.documents.brouillons', compact('documents'));
    }

    public function enAttente()
    {
        $documents = Document::with('typeDocument', 'createur')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.documents.en-attente', compact('documents'));
    }

    public function signes()
    {
        $documents = Document::with('typeDocument', 'createur')
            ->where('statut', 'signe')
            ->orderBy('date_signature', 'desc')
            ->paginate(15);

        return view('back.juridique.documents.signes', compact('documents'));
    }

    public function archives()
    {
        $documents = Document::with('typeDocument', 'createur')
            ->where('statut', 'archive')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        return view('back.juridique.documents.archives', compact('documents'));
    }

    public function create()
    {
        $typesDocuments = TypeDocument::where('is_active', true)->orderBy('nom')->get();
        $modelesDocuments = ModeleDocument::where('is_active', true)->get();
        $utilisateurs = User::orderBy('name')->get();
        $entreprises = Entreprise::orderBy('nom')->get();

        return view('back.juridique.documents.create', compact(
            'typesDocuments', 'modelesDocuments', 'utilisateurs', 'entreprises'
        ));
    }

    public function store(DocumentRequest $request)
    {
        $data = $request->validated();

        // Générer un numéro unique
        $typeDocument = TypeDocument::find($data['type_document_id']);
        $data['numero_unique'] = $this->genererNumeroUnique($typeDocument);

        // Gérer le fichier
        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('documents', 'public');
            $data['fichier_path'] = $path;
        }

        $data['cree_par'] = auth()->id();
        $document = Document::create($data);

        // Associer les utilisateurs
        if ($request->has('utilisateurs')) {
            foreach ($request->utilisateurs as $userData) {
                $document->utilisateurs()->attach($userData['id'], [
                    'role' => $userData['role'],
                    'metadatas' => json_encode($userData['metadatas'] ?? [])
                ]);
            }
        }

        // Associer les entreprises
        if ($request->has('entreprises')) {
            foreach ($request->entreprises as $entrepriseData) {
                $document->entreprises()->attach($entrepriseData['id'], [
                    'role' => $entrepriseData['role'],
                    'metadatas' => json_encode($entrepriseData['metadatas'] ?? [])
                ]);
            }
        }

        return redirect()
            ->route('back.juridique.documents.show', $document)
            ->with('success', 'Document créé avec succès.');
    }

    public function show(Document $document)
    {
        $document->load([
            'typeDocument',
            'modeleDocument',
            'createur',
            'valideur',
            'signatures.user',
            'contrat',
            'engagement',
            'utilisateurs',
            'entreprises'
        ]);

        $historique = $this->getHistorique($document);

        return view('back.juridique.documents.show', compact('document', 'historique'));
    }

    public function edit(Document $document)
    {
        $typesDocuments = TypeDocument::where('is_active', true)->orderBy('nom')->get();
        $modelesDocuments = ModeleDocument::where('is_active', true)->get();
        $utilisateurs = User::orderBy('name')->get();
        $entreprises = Entreprise::orderBy('nom')->get();

        $utilisateursAssocies = $document->utilisateurs->pluck('id')->toArray();
        $entreprisesAssociees = $document->entreprises->pluck('id')->toArray();

        return view('back.juridique.documents.edit', compact(
            'document', 'typesDocuments', 'modelesDocuments',
            'utilisateurs', 'entreprises', 'utilisateursAssocies', 'entreprisesAssociees'
        ));
    }

    public function update(DocumentRequest $request, Document $document)
    {
        $data = $request->validated();

        // Gérer le fichier
        if ($request->hasFile('fichier')) {
            if ($document->fichier_path) {
                \Storage::disk('public')->delete($document->fichier_path);
            }
            $path = $request->file('fichier')->store('documents', 'public');
            $data['fichier_path'] = $path;
        }

        $document->update($data);

        // Mettre à jour les utilisateurs
        if ($request->has('utilisateurs')) {
            $syncData = [];
            foreach ($request->utilisateurs as $userData) {
                $syncData[$userData['id']] = [
                    'role' => $userData['role'],
                    'metadatas' => json_encode($userData['metadatas'] ?? [])
                ];
            }
            $document->utilisateurs()->sync($syncData);
        }

        // Mettre à jour les entreprises
        if ($request->has('entreprises')) {
            $syncData = [];
            foreach ($request->entreprises as $entrepriseData) {
                $syncData[$entrepriseData['id']] = [
                    'role' => $entrepriseData['role'],
                    'metadatas' => json_encode($entrepriseData['metadatas'] ?? [])
                ];
            }
            $document->entreprises()->sync($syncData);
        }

        return redirect()
            ->route('back.juridique.documents.show', $document)
            ->with('success', 'Document mis à jour avec succès.');
    }

    public function destroy(Document $document)
    {
        // Supprimer le fichier PDF
        if ($document->fichier_path) {
            \Storage::disk('public')->delete($document->fichier_path);
        }

        $document->delete();

        return redirect()
            ->route('back.juridique.documents.index')
            ->with('success', 'Document supprimé avec succès.');
    }

    public function valider(Document $document)
    {
        $document->update([
            'statut' => 'valide',
            'valide_par' => auth()->id(),
            'valide_le' => now()
        ]);

        return redirect()
            ->back()
            ->with('success', 'Document validé avec succès.');
    }

    public function archiver(Document $document)
    {
        $document->update(['statut' => 'archive']);

        return redirect()
            ->back()
            ->with('success', 'Document archivé avec succès.');
    }

    public function genererPDF(Document $document)
    {
        try {
            $pdf = $this->documentGenerationService->generatePDF($document);
            return $pdf->download("document_{$document->numero_unique}.pdf");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la génération du PDF: ' . $e->getMessage());
        }
    }

    private function genererNumeroUnique(TypeDocument $typeDocument)
    {
        $prefix = strtoupper(substr($typeDocument->code, 0, 3));
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $random = strtoupper(substr(uniqid(), -4));

        return "{$prefix}-{$year}{$month}{$day}-{$random}";
    }

    private function getHistorique(Document $document)
    {
        $historique = [];

        // Création
        $historique[] = [
            'date' => $document->created_at,
            'action' => 'Création',
            'utilisateur' => $document->createur->name,
            'details' => 'Document créé en statut ' . $document->statut_label
        ];

        // Validation
        if ($document->valide_par) {
            $historique[] = [
                'date' => $document->valide_le,
                'action' => 'Validation',
                'utilisateur' => $document->valideur->name ?? 'Inconnu',
                'details' => 'Document validé'
            ];
        }

        // Signatures
        foreach ($document->signatures as $signature) {
            if ($signature->date_signature) {
                $historique[] = [
                    'date' => $signature->date_signature,
                    'action' => 'Signature',
                    'utilisateur' => $signature->user->name,
                    'details' => "Signature {$signature->type_signataire_label}"
                ];
            }
        }

        // Tri par date
        usort($historique, function($a, $b) {
            return $b['date'] <=> $a['date'];
        });

        return $historique;
    }
}
