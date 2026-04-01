<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\PolitiqueConfidentialiteRequest;
use App\Models\Juridique\PolitiqueConfidentialite;
use Illuminate\Http\Request;

class PolitiqueConfidentialiteController extends Controller
{
    public function index()
    {
        $politiques = PolitiqueConfidentialite::with('createur')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.politiques.index', compact('politiques'));
    }

    public function actives()
    {
        $politiques = PolitiqueConfidentialite::with('createur')
            ->actives()
            ->orderBy('date_effet', 'desc')
            ->paginate(15);

        return view('back.juridique.politiques.actives', compact('politiques'));
    }

    public function create()
    {
        return view('back.juridique.politiques.create');
    }

    public function store(PolitiqueConfidentialiteRequest $request)
    {
        $data = $request->validated();
        $data['cree_par'] = auth()->id();

        $politique = PolitiqueConfidentialite::create($data);

        return redirect()
            ->route('back.juridique.politiques.show', $politique)
            ->with('success', 'Politique de confidentialité créée avec succès.');
    }

    public function show(PolitiqueConfidentialite $politiqueConfidentialite)
    {
        return view('back.juridique.politiques.show', compact('politiqueConfidentialite'));
    }

    public function edit(PolitiqueConfidentialite $politiqueConfidentialite)
    {
        return view('back.juridique.politiques.edit', compact('politiqueConfidentialite'));
    }

    public function update(PolitiqueConfidentialiteRequest $request, PolitiqueConfidentialite $politiqueConfidentialite)
    {
        $politiqueConfidentialite->update($request->validated());

        return redirect()
            ->route('back.juridique.politiques.show', $politiqueConfidentialite)
            ->with('success', 'Politique de confidentialité mise à jour avec succès.');
    }

    public function destroy(PolitiqueConfidentialite $politiqueConfidentialite)
    {
        $politiqueConfidentialite->delete();

        return redirect()
            ->route('back.juridique.politiques.index')
            ->with('success', 'Politique de confidentialité supprimée avec succès.');
    }

    public function activer(PolitiqueConfidentialite $politiqueConfidentialite)
    {
        PolitiqueConfidentialite::where('id', '!=', $politiqueConfidentialite->id)
            ->update(['is_active' => false]);

        $politiqueConfidentialite->update(['is_active' => true]);

        return redirect()
            ->back()
            ->with('success', 'Politique de confidentialité activée avec succès.');
    }
}
