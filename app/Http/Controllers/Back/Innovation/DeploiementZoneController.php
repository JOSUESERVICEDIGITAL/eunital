<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\DeploiementZoneRequest;
use App\Models\Innovation\DeploiementInnovation;
use App\Models\Innovation\DeploiementZone;
use Illuminate\Http\Request;

class DeploiementZoneController extends Controller
{
    public function index(Request $request)
    {
        $query = DeploiementZone::with('deploiement');

        if ($request->filled('deploiement_innovation_id')) {
            $query->where('deploiement_innovation_id', $request->deploiement_innovation_id);
        }

        $zones = $query->latest()->paginate(15);

        return view('back.innovations.deploiement-zones.index', compact('zones'));
    }

    public function create()
    {
        return view('back.innovations.deploiement-zones.create', [
            'deploiements' => DeploiementInnovation::all(),
        ]);
    }

    public function store(DeploiementZoneRequest $request)
    {
        $zone = DeploiementZone::create($request->validated());

        return redirect()->route('back.innovations.deploiement-zones.show', $zone);
    }

    public function show(DeploiementZone $zone)
    {
        return view('back.innovations.deploiement-zones.show', compact('zone'));
    }

    public function destroy(DeploiementZone $zone)
    {
        $zone->delete();

        return back()->with('success', 'Zone supprimée');
    }
}
