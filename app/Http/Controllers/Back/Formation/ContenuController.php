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

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $uploadResult = $this->videoStorage->upload($file, 'local', 'cours/contenus');

            if ($uploadResult['success']) {
                $data['fichier'] = $uploadResult['path'];
            }
        }

        $contenu = Contenu::create($data);

        return redirect()->back()->with('success', 'Contenu créé avec succès.');
    }

    public function show(Contenu $contenu)
    {
        return view('back.formation.contenus.show', compact('contenu'));
    }

    public function edit(Contenu $contenu)
    {
        $chapitres = Chapitre::all();
        return view('back.formation.contenus.edit', compact('contenu', 'chapitres'));
    }

    public function update(ContenuRequest $request, Contenu $contenu)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $uploadResult = $this->videoStorage->upload($file, 'local', 'cours/contenus');

            if ($uploadResult['success']) {
                $data['fichier'] = $uploadResult['path'];
            }
        }

        $contenu->update($data);

        return redirect()->back()->with('success', 'Contenu mis à jour');
    }

    public function destroy(Contenu $contenu)
    {
        $contenu->delete();

        return redirect()->back()->with('success', 'Supprimé avec succès');
    }

    public function download(Contenu $contenu)
    {
        if ($contenu->fichier && Storage::disk('public')->exists($contenu->fichier)) {
            return response()->download(storage_path('app/public/' . $contenu->fichier));
        }

        abort(404);
    }

    public function toggleVisibility(Contenu $contenu)
    {
        $contenu->update(['is_visible' => !$contenu->is_visible]);

        return response()->json(['success' => true]);
    }

    public function reorder(Request $request)
    {
        foreach ($request->contenus as $item) {
            Contenu::where('id', $item['id'])->update(['ordre' => $item['ordre']]);
        }

        return response()->json(['success' => true]);
    }

    public function uploadRessource(Request $request)
    {
        $file = $request->file('fichier');
        $path = $file->store('cours/ressources', 'public');

        return response()->json(['path' => $path]);
    }
}
