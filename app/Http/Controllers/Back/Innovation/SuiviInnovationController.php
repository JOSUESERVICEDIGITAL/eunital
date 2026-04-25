<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\SuiviInnovationRequest;
use App\Models\Innovation\SuiviInnovation;
use App\Models\Innovation\Innovation;
use App\Models\User;
use Illuminate\Http\Request;

class SuiviInnovationController extends Controller
{
    public function index(Request $request)
    {
        $query = SuiviInnovation::with(['innovation', 'redacteur'])
            ->withCount(['etapes', 'blocages', 'notifications']);

        if ($request->filled('innovation_id')) {
            $query->where('innovation_id', $request->innovation_id);
        }

        if ($request->filled('statut_global')) {
            $query->where('statut_global', $request->statut_global);
        }

        $suivis = $query->latest('date_suivi')->paginate(15);

        return view('back.innovations.suivis.index', compact('suivis'));
    }

    public function create()
    {
        return view('back.innovations.suivis.create', [
            'innovations' => Innovation::all(),
            'users' => User::all(),
        ]);
    }

    public function store(SuiviInnovationRequest $request)
    {
        $suivi = SuiviInnovation::create($request->validated());

        return redirect()->route('back.innovations.suivis.show', $suivi)
            ->with('success', 'Suivi créé');
    }

    public function show(SuiviInnovation $suivi)
    {
        $suivi->load(['etapes', 'blocages', 'notifications']);

        return view('back.innovations.suivis.show', compact('suivi'));
    }

    public function update(SuiviInnovationRequest $request, SuiviInnovation $suivi)
    {
        $suivi->update($request->validated());

        return back()->with('success', 'Mis à jour');
    }

    public function destroy(SuiviInnovation $suivi)
    {
        $suivi->delete();

        return back()->with('success', 'Supprimé');
    }

    public function timeline(SuiviInnovation $suivi)
    {
        $suivi->load('etapes');

        return view('back.innovations.suivis.timeline', compact('suivi'));
    }

    public function blocages(SuiviInnovation $suivi)
    {
        $suivi->load('blocages');

        return view('back.innovations.suivis.blocages', compact('suivi'));
    }

    public function notifier(SuiviInnovation $suivi, Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $suivi->notifications()->create([
            'message' => $request->message,
            'destinataire_id' => $request->destinataire_id,
        ]);

        return back()->with('success', 'Notification envoyée');
    }
}
