<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\ArchiveJuridiqueRequest;
use App\Models\Juridique\ArchiveJuridique;
use Illuminate\Http\Request;

class ArchiveJuridiqueController extends Controller
{
    public function index()
    {
        $archives = ArchiveJuridique::with('archiveur')
            ->orderBy('date_archivage', 'desc')
            ->paginate(20);

        return view('back.juridique.archives.index', compact('archives'));
    }

    public function documents()
    {
        $archives = ArchiveJuridique::with('archiveur')
            ->where('type', 'document')
            ->orderBy('date_archivage', 'desc')
            ->paginate(20);

        return view('back.juridique.archives.documents', compact('archives'));
    }

    public function contrats()
    {
        $archives = ArchiveJuridique::with('archiveur')
            ->where('type', 'contrat')
            ->orderBy('date_archivage', 'desc')
            ->paginate(20);

        return view('back.juridique.archives.contrats', compact('archives'));
    }

    public function litiges()
    {
        $archives = ArchiveJuridique::with('archiveur')
            ->where('type', 'litige')
            ->orderBy('date_archivage', 'desc')
            ->paginate(20);

        return view('back.juridique.archives.litiges', compact('archives'));
    }

    public function create()
    {
        return view('back.juridique.archives.create');
    }

    public function store(ArchiveJuridiqueRequest $request)
    {
        $data = $request->validated();
        $data['archive_par'] = auth()->id();

        $archive = ArchiveJuridique::create($data);

        return redirect()
            ->route('back.juridique.archives.show', $archive)
            ->with('success', 'Archive créée avec succès.');
    }

    public function show(ArchiveJuridique $archiveJuridique)
    {
        $archiveJuridique->load('archiveur');

        return view('back.juridique.archives.show', compact('archiveJuridique'));
    }

    public function edit(ArchiveJuridique $archiveJuridique)
    {
        return view('back.juridique.archives.edit', compact('archiveJuridique'));
    }

    public function update(ArchiveJuridiqueRequest $request, ArchiveJuridique $archiveJuridique)
    {
        $archiveJuridique->update($request->validated());

        return redirect()
            ->route('back.juridique.archives.show', $archiveJuridique)
            ->with('success', 'Archive mise à jour avec succès.');
    }

    public function destroy(ArchiveJuridique $archiveJuridique)
    {
        $archiveJuridique->delete();

        return redirect()
            ->route('back.juridique.archives.index')
            ->with('success', 'Archive supprimée avec succès.');
    }

    public function restaurer(ArchiveJuridique $archiveJuridique)
    {
        // Restaurer l'élément original
        $model = "App\\Models\\Juridique\\" . ucfirst($archiveJuridique->type);
        $item = $model::withTrashed()->find($archiveJuridique->item_id);

        if ($item && $item->trashed()) {
            $item->restore();
        }

        $archiveJuridique->update(['statut_conservation' => 'detruit']);

        return redirect()
            ->back()
            ->with('success', 'Élément restauré avec succès.');
    }

    public function marquerADetruire(ArchiveJuridique $archiveJuridique)
    {
        $archiveJuridique->marquerADetruire();

        return redirect()
            ->back()
            ->with('success', 'Archive marquée à détruire.');
    }

    public function politiqueConservation()
    {
        $archives = ArchiveJuridique::select('type', \DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get();

        $stats = [
            'total' => ArchiveJuridique::count(),
            'a_detruire' => ArchiveJuridique::where('statut_conservation', 'a_detruire')->count(),
            'detruites' => ArchiveJuridique::where('statut_conservation', 'detruit')->count(),
            'par_type' => $archives
        ];

        return view('back.juridique.archives.politique', compact('stats'));
    }
}
