<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\CguCgvRequest;
use App\Models\Juridique\CguCgv;
use Illuminate\Http\Request;

class CguCgvController extends Controller
{
    public function index()
    {
        $cgus = CguCgv::with('createur')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.cgu.index', compact('cgus'));
    }

    public function cgu()
    {
        $cgus = CguCgv::with('createur')
            ->where('type', 'cgu')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.cgu.cgu', compact('cgus'));
    }

    public function cgv()
    {
        $cgus = CguCgv::with('createur')
            ->where('type', 'cgv')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.cgu.cgv', compact('cgus'));
    }

    public function actives()
    {
        $cgus = CguCgv::with('createur')
            ->actives()
            ->orderBy('date_effet', 'desc')
            ->paginate(15);

        return view('back.juridique.cgu.actives', compact('cgus'));
    }

    public function create()
    {
        $types = ['cgu' => 'CGU', 'cgv' => 'CGV'];

        return view('back.juridique.cgu.create', compact('types'));
    }

    public function store(CguCgvRequest $request)
    {
        $data = $request->validated();
        $data['cree_par'] = auth()->id();

        $cgu = CguCgv::create($data);

        return redirect()
            ->route('back.juridique.cgu.show', $cgu)
            ->with('success', 'CGU/CGV créée avec succès.');
    }

    public function show(CguCgv $cguCgv)
    {
        return view('back.juridique.cgu.show', compact('cguCgv'));
    }

    public function edit(CguCgv $cguCgv)
    {
        $types = ['cgu' => 'CGU', 'cgv' => 'CGV'];

        return view('back.juridique.cgu.edit', compact('cguCgv', 'types'));
    }

    public function update(CguCgvRequest $request, CguCgv $cguCgv)
    {
        $cguCgv->update($request->validated());

        return redirect()
            ->route('back.juridique.cgu.show', $cguCgv)
            ->with('success', 'CGU/CGV mise à jour avec succès.');
    }

    public function destroy(CguCgv $cguCgv)
    {
        $cguCgv->delete();

        return redirect()
            ->route('back.juridique.cgu.index')
            ->with('success', 'CGU/CGV supprimée avec succès.');
    }

    public function activer(CguCgv $cguCgv)
    {
        // Désactiver les autres versions du même type
        CguCgv::where('type', $cguCgv->type)
            ->where('id', '!=', $cguCgv->id)
            ->update(['is_active' => false]);

        $cguCgv->update(['is_active' => true]);

        return redirect()
            ->back()
            ->with('success', 'CGU/CGV activée avec succès.');
    }
}
