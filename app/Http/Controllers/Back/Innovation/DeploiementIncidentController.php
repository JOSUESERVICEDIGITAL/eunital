<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\DeploiementIncidentRequest;
use App\Models\Innovation\DeploiementIncident;
use App\Models\Innovation\DeploiementInnovation;
use Illuminate\Http\Request;

class DeploiementIncidentController extends Controller
{
    public function index()
    {
        $incidents = DeploiementIncident::with('deploiement')->paginate(15);

        return view('back.innovations.deploiement-incidents.index', compact('incidents'));
    }

    public function store(DeploiementIncidentRequest $request)
    {
        DeploiementIncident::create($request->validated());

        return back()->with('success', 'Incident enregistré');
    }

    public function resoudre(DeploiementIncident $incident)
    {
        $incident->update([
            'statut' => 'resolu',
            'date_resolution' => now(),
        ]);

        return back()->with('success', 'Incident résolu');
    }

    public function critiques()
    {
        $incidents = DeploiementIncident::where('niveau', 'critique')->get();

        return view('back.innovations.deploiement-incidents.critiques', compact('incidents'));
    }
}
