<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Models\Juridique\ArchiveJuridique;
use App\Models\Juridique\Document;
use App\Models\Juridique\Contrat;
use App\Models\Juridique\Litige;
use Illuminate\Http\Request;

class ArchiveController extends Controller
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

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|in:document,contrat,litige,demarche,legalite',
            'motif' => 'nullable|string'
        ]);

        $model = "App\\Models\\Juridique\\" . ucfirst($request->item_type);
        $item = $model::findOrFail($request->item_id);

        $archive = ArchiveJuridique::create([
            'reference' => $this->genererReference($request->item_type),
            'titre' => $item->titre,
            'type' => $request->item_type,
            'item_id' => $item->id,
            'item_type' => $request->item_type,
            'contenu_archive' => $item->toArray(),
            'date_archivage' => now(),
            'date_conservation_jusqu' => now()->addYears(10),
            'motif' => $request->motif,
            'archive_par' => auth()->id()
        ]);

        return redirect()
            ->back()
            ->with('success', 'Élément archivé avec succès.');
    }

    public function show(ArchiveJuridique $archive)
    {
        $archive->load('archiveur');

        return view('back.juridique.archives.show', compact('archive'));
    }

    public function restore(ArchiveJuridique $archive)
    {
        // Restaurer l'élément original
        $model = "App\\Models\\Juridique\\" . ucfirst($archive->type);
        $item = $model::withTrashed()->find($archive->item_id);

        if ($item && $item->trashed()) {
            $item->restore();
        }

        $archive->update(['statut_conservation' => 'detruit']);

        return redirect()
            ->route('back.juridique.archives.show', $archive)
            ->with('success', 'Élément restauré avec succès.');
    }

    public function marquerADetruire(ArchiveJuridique $archive)
    {
        $archive->marquerADetruire();

        return redirect()
            ->back()
            ->with('success', 'Archive marquée à détruire.');
    }

    public function destroy(ArchiveJuridique $archive)
    {
        $archive->delete();

        return redirect()
            ->route('back.juridique.archives.index')
            ->with('success', 'Archive supprimée définitivement.');
    }

    private function genererReference($type)
    {
        $prefix = strtoupper(substr($type, 0, 3));
        $year = date('Y');
        $month = date('m');
        $random = strtoupper(substr(uniqid(), -6));

        return "ARCH-{$prefix}-{$year}{$month}-{$random}";
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
