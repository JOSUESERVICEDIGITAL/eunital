<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\ModeleDocumentRequest;
use App\Models\Juridique\ModeleDocument;
use App\Models\Juridique\TypeDocument;
use Illuminate\Http\Request;

class ModeleDocumentController extends Controller
{
    public function index()
    {
        $modeles = ModeleDocument::with('typeDocument', 'createur')
            ->orderBy('type_document_id')
            ->orderBy('titre')
            ->paginate(15);

        return view('back.juridique.modeles.index', compact('modeles'));
    }

    public function actifs()
    {
        $modeles = ModeleDocument::with('typeDocument', 'createur')
            ->where('is_active', true)
            ->orderBy('titre')
            ->paginate(15);

        return view('back.juridique.modeles.actifs', compact('modeles'));
    }

    public function parDefaut()
    {
        $modeles = ModeleDocument::with('typeDocument', 'createur')
            ->where('is_default', true)
            ->orderBy('titre')
            ->paginate(15);

        return view('back.juridique.modeles.par-defaut', compact('modeles'));
    }

    public function create()
    {
        $typesDocuments = TypeDocument::where('is_active', true)->orderBy('nom')->get();

        return view('back.juridique.modeles.create', compact('typesDocuments'));
    }

    public function store(ModeleDocumentRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();

        // Si c'est le modèle par défaut, désactiver les autres
        if ($data['is_default'] ?? false) {
            ModeleDocument::where('type_document_id', $data['type_document_id'])
                ->update(['is_default' => false]);
        }

        $modele = ModeleDocument::create($data);

        return redirect()
            ->route('back.juridique.modeles.show', $modele)
            ->with('success', 'Modèle de document créé avec succès.');
    }

    public function show(ModeleDocument $modeleDocument)
    {
        $modeleDocument->load(['typeDocument', 'createur']);

        $stats = [
            'documents_utilises' => $modeleDocument->documents()->count(),
            'derniere_utilisation' => $modeleDocument->documents()->latest()->first()?->created_at,
            'version_actuelle' => $modeleDocument->version
        ];

        return view('back.juridique.modeles.show', compact('modeleDocument', 'stats'));
    }

    public function edit(ModeleDocument $modeleDocument)
    {
        $typesDocuments = TypeDocument::where('is_active', true)->orderBy('nom')->get();

        return view('back.juridique.modeles.edit', compact('modeleDocument', 'typesDocuments'));
    }

    public function update(ModeleDocumentRequest $request, ModeleDocument $modeleDocument)
    {
        $data = $request->validated();

        // Gérer la version
        if ($modeleDocument->contenu_html !== $data['contenu_html'] ||
            $modeleDocument->contenu_pdf !== $data['contenu_pdf']) {
            $parts = explode('.', $modeleDocument->version);
            $newVersion = ($parts[0] ?? 1) . '.' . (($parts[1] ?? 0) + 1);
            $data['version'] = $newVersion;
        }

        // Si c'est le modèle par défaut, désactiver les autres
        if (($data['is_default'] ?? false) && !$modeleDocument->is_default) {
            ModeleDocument::where('type_document_id', $data['type_document_id'])
                ->update(['is_default' => false]);
        }

        $modeleDocument->update($data);

        return redirect()
            ->route('back.juridique.modeles.show', $modeleDocument)
            ->with('success', 'Modèle de document mis à jour avec succès.');
    }

    public function destroy(ModeleDocument $modeleDocument)
    {
        if ($modeleDocument->documents()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Impossible de supprimer ce modèle car des documents l\'utilisent.');
        }

        $modeleDocument->delete();

        return redirect()
            ->route('back.juridique.modeles.index')
            ->with('success', 'Modèle de document supprimé avec succès.');
    }

    public function toggleActive(ModeleDocument $modeleDocument)
    {
        $modeleDocument->update(['is_active' => !$modeleDocument->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $modeleDocument->is_active
        ]);
    }

    public function setDefault(ModeleDocument $modeleDocument)
    {
        // Désactiver les autres modèles du même type
        ModeleDocument::where('type_document_id', $modeleDocument->type_document_id)
            ->update(['is_default' => false]);

        $modeleDocument->update(['is_default' => true]);

        return redirect()
            ->back()
            ->with('success', 'Modèle défini par défaut avec succès.');
    }

    public function preview(Request $request, ModeleDocument $modeleDocument)
    {
        $variables = $request->get('variables', []);

        $contenu = $modeleDocument->contenu_html;
        foreach ($variables as $key => $value) {
            $contenu = str_replace("{{ $key }}", $value, $contenu);
        }

        return response()->json([
            'success' => true,
            'contenu' => $contenu
        ]);
    }
}
