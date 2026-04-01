<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\GenerationDocumentRequest;
use App\Models\Juridique\ModeleDocument;
use App\Models\Juridique\TypeDocument;
use App\Models\Juridique\Document;
use App\Models\User;
use App\Models\Entreprise;
use App\Services\Juridique\DocumentGenerationService;
use Illuminate\Http\Request;

class GenerationDocumentController extends Controller
{
    protected $documentGenerationService;

    public function __construct(DocumentGenerationService $documentGenerationService)
    {
        $this->documentGenerationService = $documentGenerationService;
    }

    public function index()
    {
        $modeles = ModeleDocument::with('typeDocument')
            ->where('is_active', true)
            ->orderBy('type_document_id')
            ->orderBy('titre')
            ->get();

        $typesDocuments = TypeDocument::where('is_active', true)->orderBy('nom')->get();

        return view('back.juridique.generation.index', compact('modeles', 'typesDocuments'));
    }

    public function create()
    {
        $modeles = ModeleDocument::with('typeDocument')
            ->where('is_active', true)
            ->orderBy('titre')
            ->get();

        $typesDocuments = TypeDocument::where('is_active', true)->orderBy('nom')->get();
        $utilisateurs = User::orderBy('name')->get();
        $entreprises = Entreprise::orderBy('nom')->get();

        return view('back.juridique.generation.create', compact(
            'modeles', 'typesDocuments', 'utilisateurs', 'entreprises'
        ));
    }

    public function store(GenerationDocumentRequest $request)
    {
        // Récupérer le modèle
        $modele = ModeleDocument::with('typeDocument')->find($request->modele_document_id);

        // Générer le contenu HTML
        $contenuHtml = $this->genererContenu($modele->contenu_html, $request->variables);

        // Générer le contenu PDF
        $contenuPdf = $this->genererContenu($modele->contenu_pdf, $request->variables);

        // Créer le document
        $documentData = [
            'titre' => $request->titre,
            'description' => $request->description,
            'type_document_id' => $request->type_document_id,
            'modele_document_id' => $request->modele_document_id,
            'contenu' => [
                'html' => $contenuHtml,
                'pdf' => $contenuPdf
            ],
            'variables_utilisees' => $request->variables,
            'date_effet' => $request->date_effet,
            'date_expiration' => $request->date_expiration,
            'statut' => 'brouillon',
            'cree_par' => auth()->id()
        ];

        $document = Document::create($documentData);

        // Associer les utilisateurs
        if ($request->has('utilisateurs')) {
            foreach ($request->utilisateurs as $userData) {
                $document->utilisateurs()->attach($userData['id'], [
                    'role' => $userData['role']
                ]);
            }
        }

        // Associer les entreprises
        if ($request->has('entreprises')) {
            foreach ($request->entreprises as $entrepriseData) {
                $document->entreprises()->attach($entrepriseData['id'], [
                    'role' => $entrepriseData['role']
                ]);
            }
        }

        // Générer le PDF
        if ($request->format === 'pdf' || $request->format === 'both') {
            $this->documentGenerationService->generatePDF($document);
        }

        return redirect()
            ->route('back.juridique.documents.show', $document)
            ->with('success', 'Document généré avec succès.');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'modele_document_id' => 'required|exists:modeles_documents,id',
            'variables' => 'nullable|array'
        ]);

        $modele = ModeleDocument::find($request->modele_document_id);
        $contenu = $this->genererContenu($modele->contenu_html, $request->variables);

        return response()->json([
            'success' => true,
            'contenu' => $contenu
        ]);
    }

    public function getVariables(ModeleDocument $modeleDocument)
    {
        return response()->json([
            'success' => true,
            'variables' => $modeleDocument->variables,
            'champs_requis' => $modeleDocument->champs_requis
        ]);
    }

    public function getChampsRequis(ModeleDocument $modeleDocument)
    {
        return response()->json([
            'success' => true,
            'champs_requis' => $modeleDocument->champs_requis
        ]);
    }

    private function genererContenu($template, $variables)
    {
        $contenu = $template;

        if ($variables) {
            foreach ($variables as $key => $value) {
                $contenu = str_replace("{{ $key }}", $value, $contenu);
            }
        }

        return $contenu;
    }
}
