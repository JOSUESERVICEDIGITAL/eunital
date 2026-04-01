<?php

namespace App\Http\Controllers\Back\ChambreJuridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentJuridiqueRequest;
use App\Http\Requests\UpdateDocumentJuridiqueRequest;
use App\Models\DocumentJuridique;
use Illuminate\Support\Facades\Storage;

class DocumentJuridiqueController extends Controller
{
    public function listeToutes()
    {
        $documents = DocumentJuridique::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.documents.liste', compact('documents'));
    }

    public function listeActifs()
    {
        $documents = DocumentJuridique::with('auteur')
            ->where('statut', 'actif')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.documents.actifs', compact('documents'));
    }

    public function listeArchives()
    {
        $documents = DocumentJuridique::with('auteur')
            ->where('statut', 'archive')
            ->latest()
            ->paginate(12);

        return view('back.chambre-juridique.documents.archives', compact('documents'));
    }

    public function formulaireCreation()
    {
        return view('back.chambre-juridique.documents.creer');
    }

    public function enregistrer(StoreDocumentJuridiqueRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('juridique/documents', 'public');
        }

        $data['auteur_id'] = auth()->id();

        $document = DocumentJuridique::create($data);

        return redirect()
            ->route('back.chambre-juridique.documents.details', $document)
            ->with('success', 'Document juridique créé avec succès.');
    }

    public function details(DocumentJuridique $documentJuridique)
    {
        $documentJuridique->load('auteur');

        return view('back.chambre-juridique.documents.details', [
            'document' => $documentJuridique
        ]);
    }

    public function formulaireEdition(DocumentJuridique $documentJuridique)
    {
        return view('back.chambre-juridique.documents.modifier', [
            'document' => $documentJuridique
        ]);
    }

    public function mettreAJour(UpdateDocumentJuridiqueRequest $request, DocumentJuridique $documentJuridique)
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            if ($documentJuridique->fichier && Storage::disk('public')->exists($documentJuridique->fichier)) {
                Storage::disk('public')->delete($documentJuridique->fichier);
            }

            $data['fichier'] = $request->file('fichier')->store('juridique/documents', 'public');
        }

        $documentJuridique->update($data);

        return redirect()
            ->route('back.chambre-juridique.documents.details', $documentJuridique)
            ->with('success', 'Document mis à jour avec succès.');
    }

    public function activer(DocumentJuridique $documentJuridique)
    {
        $documentJuridique->update(['statut' => 'actif']);

        return back()->with('success', 'Document activé.');
    }

    public function archiver(DocumentJuridique $documentJuridique)
    {
        $documentJuridique->update(['statut' => 'archive']);

        return back()->with('success', 'Document archivé.');
    }

    public function supprimer(DocumentJuridique $documentJuridique)
    {
        if ($documentJuridique->fichier && Storage::disk('public')->exists($documentJuridique->fichier)) {
            Storage::disk('public')->delete($documentJuridique->fichier);
        }

        $documentJuridique->delete();

        return redirect()
            ->route('back.chambre-juridique.documents.toutes')
            ->with('success', 'Document supprimé avec succès.');
    }
}
