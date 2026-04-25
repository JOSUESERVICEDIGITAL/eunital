<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\ExperimentationSiteRequest;
use App\Models\Innovation\Experimentation;
use App\Models\Innovation\ExperimentationSite;
use Illuminate\Http\Request;

class ExperimentationSiteController extends Controller
{
    public function index(Request $request)
    {
        $query = ExperimentationSite::with('experimentation');

        if ($request->filled('experimentation_id')) {
            $query->where('experimentation_id', $request->experimentation_id);
        }

        $sites = $query->latest()->paginate(15)->withQueryString();

        return view('back.innovations.experimentation-sites.index', compact('sites'));
    }

    public function create()
    {
        $experimentations = Experimentation::orderBy('titre')->get();

        return view('back.innovations.experimentation-sites.create', compact('experimentations'));
    }

    public function store(ExperimentationSiteRequest $request)
    {
        $site = ExperimentationSite::create($request->validated());

        return redirect()
            ->route('back.innovations.experimentation-sites.show', $site)
            ->with('success', 'Site ajouté.');
    }

    public function show(ExperimentationSite $site)
    {
        $site->load('experimentation');

        return view('back.innovations.experimentation-sites.show', compact('site'));
    }

    public function edit(ExperimentationSite $site)
    {
        $experimentations = Experimentation::orderBy('titre')->get();

        return view('back.innovations.experimentation-sites.edit', compact('site', 'experimentations'));
    }

    public function update(ExperimentationSiteRequest $request, ExperimentationSite $site)
    {
        $site->update($request->validated());

        return redirect()
            ->route('back.innovations.experimentation-sites.show', $site)
            ->with('success', 'Site mis à jour.');
    }

    public function destroy(ExperimentationSite $site)
    {
        $site->delete();

        return back()->with('success', 'Site supprimé.');
    }
}
