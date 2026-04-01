<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\EngagementRequest;
use App\Models\Juridique\Engagement;
use App\Models\Juridique\Document;
use Illuminate\Http\Request;

class EngagementController extends Controller
{
    public function index()
    {
        $engagements = Engagement::with('document.typeDocument')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.engagements.index', compact('engagements'));
    }

    public function actifs()
    {
        $engagements = Engagement::with('document.typeDocument')
            ->where('date_fin', '>=', now())
            ->orWhereNull('date_fin')
            ->orderBy('date_adhesion', 'desc')
            ->paginate(15);

        return view('back.juridique.engagements.actifs', compact('engagements'));
    }

    public function expires()
    {
        $engagements = Engagement::with('document.typeDocument')
            ->where('date_fin', '<', now())
            ->orderBy('date_fin', 'desc')
            ->paginate(15);

        return view('back.juridique.engagements.expires', compact('engagements'));
    }

    public function create()
    {
        $documents = Document::with('typeDocument')
            ->whereDoesntHave('engagement')
            ->where('statut', 'valide')
            ->get();

        return view('back.juridique.engagements.create', compact('documents'));
    }

    public function store(EngagementRequest $request)
    {
        $data = $request->validated();

        $document = Document::find($data['document_id']);
        if ($document->engagement) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Ce document a déjà un engagement associé.');
        }

        $engagement = Engagement::create($data);

        $document->update([
            'statut' => 'valide',
            'date_effet' => $engagement->date_adhesion,
            'date_expiration' => $engagement->date_fin
        ]);

        return redirect()
            ->route('back.juridique.engagements.show', $engagement)
            ->with('success', 'Engagement créé avec succès.');
    }

    public function show(Engagement $engagement)
    {
        $engagement->load(['document.typeDocument', 'document.signatures.user']);

        return view('back.juridique.engagements.show', compact('engagement'));
    }

    public function edit(Engagement $engagement)
    {
        $documents = Document::with('typeDocument')
            ->whereDoesntHave('engagement')
            ->orWhere('id', $engagement->document_id)
            ->where('statut', 'valide')
            ->get();

        return view('back.juridique.engagements.edit', compact('engagement', 'documents'));
    }

    public function update(EngagementRequest $request, Engagement $engagement)
    {
        $engagement->update($request->validated());

        $engagement->document->update([
            'date_effet' => $engagement->date_adhesion,
            'date_expiration' => $engagement->date_fin
        ]);

        return redirect()
            ->route('back.juridique.engagements.show', $engagement)
            ->with('success', 'Engagement mis à jour avec succès.');
    }

    public function destroy(Engagement $engagement)
    {
        $engagement->delete();

        return redirect()
            ->route('back.juridique.engagements.index')
            ->with('success', 'Engagement supprimé avec succès.');
    }

    public function export(Request $request, Engagement $engagement)
    {
        $format = $request->get('format', 'pdf');

        if ($format === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('back.juridique.engagements.pdf', compact('engagement'));
            return $pdf->download("engagement_{$engagement->reference}.pdf");
        }

        return redirect()->back()->with('info', 'Export en cours de développement.');
    }
}
