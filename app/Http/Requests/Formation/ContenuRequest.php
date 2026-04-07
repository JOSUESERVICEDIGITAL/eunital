<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\ContenuRequest;
use App\Models\Formation\Contenu;
use App\Models\Formation\Chapitre;
use App\Services\Storage\VideoStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContenuController extends Controller
{
    protected $videoStorage;

    public function __construct(VideoStorageService $videoStorage)
    {
        $this->videoStorage = $videoStorage;
    }

    public function index()
    {
        $contenus = Contenu::with('chapitre.cour')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.contenus.index', compact('contenus'));
    }

    public function videos()
    {
        $contenus = Contenu::with('chapitre.cour')
            ->whereIn('type', ['video', 'tutoriel'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.contenus.videos', compact('contenus'));
    }

    public function documents()
    {
        $contenus = Contenu::with('chapitre.cour')
            ->where('type', 'document')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.contenus.documents', compact('contenus'));
    }

    public function tutoriels()
    {
        $contenus = Contenu::with('chapitre.cour')
            ->where('type', 'tutoriel')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.contenus.tutoriels', compact('contenus'));
    }

    public function create(Request $request)
    {
        $chapitres = Chapitre::with('cour')->orderBy('cour_id')->orderBy('ordre')->get();
        $chapitreId = $request->get('chapitre_id');
        $type = $request->get('type');
        
        return view('back.formation.contenus.create', compact('chapitres', 'chapitreId', 'type'));
    }

    public function store(ContenuRequest $request)
    {
        $data = $request->validated();
        
        // Gestion du fichier uploadé
        if ($request->hasFile('fichier')) {
            $storageType = $request->storage_type ?? 'local';
            $file = $request->file('fichier');
            
            $uploadResult = $this->videoStorage->upload($file, $storageType, 'cours/contenus');
            
            if ($uploadResult['success']) {
                $data['fichier'] = $uploadResult['path'] ?? null;
                $data['storage_type'] = $uploadResult['type'];
                $data['drive_file_id'] = $uploadResult['drive_id'] ?? null;
                $data['video_url'] = $uploadResult['url'] ?? null;
                $data['type_fichier'] = $uploadResult['extension'] ?? $file->getClientOriginalExtension();
                $data['taille_fichier'] = $uploadResult['size'] ?? $file->getSize();
            }
        }
        
        // Gestion de l'URL vidéo externe
        if ($request->filled('video_url')) {
            $embedUrl = $this->videoStorage->getEmbedUrl($request->video_url);
            $data['video_url'] = $embedUrl ?? $request->video_url;
            $data['storage_type'] = 'external';
        }
        
        // Gestion des ressources supplémentaires
        if ($request->hasFile('ressources')) {
            $ressources = [];
            foreach ($request->file('ressources') as $ressource) {
                $path = $ressource->store('cours/ressources', 'public');
                $ressources[] = [
                    'name' => $ressource->getClientOriginalName(),
                    'path' => $path,
                    'size' => $ressource->getSize(),
                    'type' => $ressource->getMimeType()
                ];
            }
            $data['ressources'] = json_encode($ressources);
        }
        
        // Définir l'ordre
        if (!isset($data['ordre'])) {
            $data['ordre'] = Contenu::where('chapitre_id', $data['chapitre_id'])->max('ordre') + 1;
        }
        
        $contenu = Contenu::create($data);
        
        return redirect()
            ->route('back.formation.chapitres.show', $contenu->chapitre_id)
            ->with('success', 'Contenu créé avec succès.');
    }

    public function show(Contenu $contenu)
    {
        $contenu->load('chapitre.cour');
        
        // Convertir les ressources JSON en array
        if ($contenu->ressources) {
            $contenu->ressources = json_decode($contenu->ressources, true);
        }
        
        return view('back.formation.contenus.show', compact('contenu'));
    }

    public function edit(Contenu $contenu)
    {
        $chapitres = Chapitre::with('cour')->orderBy('cour_id')->orderBy('ordre')->get();
        
        // Convertir les ressources JSON en array
        if ($contenu->ressources) {
            $contenu->ressources = json_decode($contenu->ressources, true);
        }
        
        return view('back.formation.contenus.edit', compact('contenu', 'chapitres'));
    }

    public function update(ContenuRequest $request, Contenu $contenu)
    {
        $data = $request->validated();
        
        // Gestion du nouveau fichier
        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier
            $oldFile = [
                'type' => $contenu->storage_type,
                'path' => $contenu->fichier,
                'drive_id' => $contenu->drive_file_id
            ];
            $this->videoStorage->delete($oldFile);
            
            $storageType = $request->storage_type ?? 'local';
            $file = $request->file('fichier');
            
            $uploadResult = $this->videoStorage->upload($file, $storageType, 'cours/contenus');
            
            if ($uploadResult['success']) {
                $data['fichier'] = $uploadResult['path'] ?? null;
                $data['storage_type'] = $uploadResult['type'];
                $data['drive_file_id'] = $uploadResult['drive_id'] ?? null;
                $data['video_url'] = $uploadResult['url'] ?? null;
                $data['type_fichier'] = $uploadResult['extension'] ?? $file->getClientOriginalExtension();
                $data['taille_fichier'] = $uploadResult['size'] ?? $file->getSize();
            }
        }
        
        // Gestion de la nouvelle URL vidéo
        if ($request->filled('video_url')) {
            $embedUrl = $this->videoStorage->getEmbedUrl($request->video_url);
            $data['video_url'] = $embedUrl ?? $request->video_url;
            $data['storage_type'] = 'external';
        } elseif ($request->filled('video_url') === false && $contenu->storage_type === 'external') {
            $data['video_url'] = null;
        }
        
        // Gestion des nouvelles ressources
        if ($request->hasFile('ressources')) {
            $ressources = json_decode($contenu->ressources, true) ?? [];
            foreach ($request->file('ressources') as $ressource) {
                $path = $ressource->store('cours/ressources', 'public');
                $ressources[] = [
                    'name' => $ressource->getClientOriginalName(),
                    'path' => $path,
                    'size' => $ressource->getSize(),
                    'type' => $ressource->getMimeType()
                ];
            }
            $data['ressources'] = json_encode($ressources);
        }
        
        $contenu->update($data);
        
        return redirect()
            ->route('back.formation.chapitres.show', $contenu->chapitre_id)
            ->with('success', 'Contenu mis à jour avec succès.');
    }

    public function destroy(Contenu $contenu)
    {
        // Supprimer le fichier associé
        $file = [
            'type' => $contenu->storage_type,
            'path' => $contenu->fichier,
            'drive_id' => $contenu->drive_file_id
        ];
        $this->videoStorage->delete($file);
        
        // Supprimer les ressources
        if ($contenu->ressources) {
            $ressources = json_decode($contenu->ressources, true);
            foreach ($ressources as $ressource) {
                if (isset($ressource['path'])) {
                    Storage::disk('public')->delete($ressource['path']);
                }
            }
        }
        
        $chapitreId = $contenu->chapitre_id;
        $contenu->delete();
        
        // Réordonner les contenus restants
        $contenus = Contenu::where('chapitre_id', $chapitreId)->orderBy('ordre')->get();
        foreach ($contenus as $index => $cont) {
            $cont->update(['ordre' => $index]);
        }
        
        return redirect()
            ->route('back.formation.chapitres.show', $chapitreId)
            ->with('success', 'Contenu supprimé avec succès.');
    }

    public function download(Contenu $contenu)
    {
        if (!$contenu->telechargeable) {
            abort(403, 'Ce contenu n\'est pas téléchargeable.');
        }
        
        if ($contenu->storage_type === 'google_drive' && $contenu->drive_file_id) {
            return redirect($contenu->video_url ?? '#');
        }
        
        if ($contenu->fichier && Storage::disk('public')->exists($contenu->fichier)) {
            return response()->download(storage_path('app/public/' . $contenu->fichier));
        }
        
        abort(404, 'Fichier non trouvé.');
    }

    public function toggleVisibility(Contenu $contenu)
    {
        $contenu->update(['is_visible' => !$contenu->is_visible]);
        
        return response()->json([
            'success' => true,
            'is_visible' => $contenu->is_visible
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'contenus' => 'required|array',
            'contenus.*.id' => 'exists:contenus,id',
            'contenus.*.ordre' => 'integer|min:0'
        ]);
        
        foreach ($request->contenus as $contenuData) {
            Contenu::where('id', $contenuData['id'])->update(['ordre' => $contenuData['ordre']]);
        }
        
        return response()->json(['success' => true]);
    }

    public function uploadRessource(Request $request)
    {
        $request->validate([
            'fichier' => 'required|file|max:10240',
            'contenu_id' => 'required|exists:contenus,id'
        ]);
        
        $contenu = Contenu::find($request->contenu_id);
        $file = $request->file('fichier');
        
        $path = $file->store('cours/ressources', 'public');
        
        $ressources = json_decode($contenu->ressources, true) ?? [];
        $ressources[] = [
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'size' => $file->getSize(),
            'type' => $file->getMimeType()
        ];
        
        $contenu->update(['ressources' => json_encode($ressources)]);
        
        return response()->json([
            'success' => true,
            'message' => 'Ressource ajoutée avec succès'
        ]);
    }
}