<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\InnovationDocumentRequest;
use App\Models\Innovation\Innovation;
use App\Models\Innovation\InnovationDocument;
use Illuminate\Http\Request;

class InnovationDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = InnovationDocument::with('innovation');

        if ($request->filled('innovation_id')) {
            $query->where('innovation_id', $request->innovation_id);
        }

        $documents = $query->latest()->paginate(15)->withQueryString();

        return view('back.innovations.documents.index', compact('documents'));
    }

    public function create()
    {
        $innovations = Innovation::orderBy('titre')->get();

        return view('back.innovations.documents.create', compact('innovations'));
    }

    public function store(InnovationDocumentRequest $request)
    {
        $document = InnovationDocument::create($request->validated());

        return redirect()
            ->route('back.innovations.documents.show', $document)
            ->with('success', 'Document ajouté.');
    }

    public function show(InnovationDocument $document)
    {
        $document->load('innovation');

        return view('back.innovations.documents.show', compact('document'));
    }

    public function edit(InnovationDocument $document)
    {
        $innovations = Innovation::orderBy('titre')->get();

        return view('back.innovations.documents.edit', compact('document', 'innovations'));
    }

    public function update(InnovationDocumentRequest $request, InnovationDocument $document)
    {
        $document->update($request->validated());

        return redirect()
            ->route('back.innovations.documents.show', $document)
            ->with('success', 'Document mis à jour.');
    }

    public function destroy(InnovationDocument $document)
    {
        $document->delete();

        return back()->with('success', 'Document supprimé.');
    }

    public function telecharger(InnovationDocument $document)
    {
        return response()->download(storage_path('app/public/' . $document->fichier));
    }
}
