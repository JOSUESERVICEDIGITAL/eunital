<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\TypeDocumentRequest;
use App\Models\Juridique\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    public function index()
    {
        $types = TypeDocument::withCount('documents')
            ->orderBy('ordre')
            ->orderBy('nom')
            ->paginate(15);

        return view('back.juridique.types-documents.index', compact('types'));
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('back.juridique.types-documents.create', compact('categories'));
    }

    public function store(TypeDocumentRequest $request)
    {
        $data = $request->validated();
        $type = TypeDocument::create($data);

        return redirect()
            ->route('back.juridique.types-documents.show', $type)
            ->with('success', 'Type de document créé avec succès.');
    }

    public function show(TypeDocument $typeDocument)
    {
        $typeDocument->load(['modeles', 'documents' => function($query) {
            $query->orderBy('created_at', 'desc')->limit(10);
        }]);

        $stats = [
            'total_documents' => $typeDocument->documents()->count(),
            'total_modeles' => $typeDocument->modeles()->count(),
            'documents_signes' => $typeDocument->documents()->where('statut', 'signe')->count(),
            'documents_en_attente' => $typeDocument->documents()->where('statut', 'en_attente')->count(),
        ];

        return view('back.juridique.types-documents.show', compact('typeDocument', 'stats'));
    }

    public function edit(TypeDocument $typeDocument)
    {
        $categories = $this->getCategories();
        return view('back.juridique.types-documents.edit', compact('typeDocument', 'categories'));
    }

    public function update(TypeDocumentRequest $request, TypeDocument $typeDocument)
    {
        $typeDocument->update($request->validated());

        return redirect()
            ->route('back.juridique.types-documents.show', $typeDocument)
            ->with('success', 'Type de document mis à jour avec succès.');
    }

    public function destroy(TypeDocument $typeDocument)
    {
        if ($typeDocument->documents()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Impossible de supprimer ce type car des documents y sont associés.');
        }

        $typeDocument->delete();

        return redirect()
            ->route('back.juridique.types-documents.index')
            ->with('success', 'Type de document supprimé avec succès.');
    }

    public function toggleActive(TypeDocument $typeDocument)
    {
        $typeDocument->update(['is_active' => !$typeDocument->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $typeDocument->is_active
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:types_documents,id'
        ]);

        foreach ($request->order as $index => $id) {
            TypeDocument::where('id', $id)->update(['ordre' => $index]);
        }

        return response()->json(['success' => true]);
    }

    private function getCategories()
    {
        return [
            'contrat' => 'Contrat',
            'engagement' => 'Engagement',
            'legal' => 'Légal',
            'administratif' => 'Administratif',
            'conformite' => 'Conformité',
            'rgpd' => 'RGPD',
            'commercial' => 'Commercial',
            'rh' => 'Ressources Humaines',
            'formation' => 'Formation',
            'partenariat' => 'Partenariat',
            'finance' => 'Finance',
            'technique' => 'Technique'
        ];
    }
}
