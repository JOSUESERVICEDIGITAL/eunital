<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\ContratRequest;
use App\Models\Juridique\Contrat;
use App\Models\Juridique\Document;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    public function index()
    {
        $contrats = Contrat::with('document.typeDocument')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.contrats.index', compact('contrats'));
    }

    public function actifs()
    {
        $contrats = Contrat::with('document.typeDocument')
            ->where('date_fin', '>=', now())
            ->orWhereNull('date_fin')
            ->orderBy('date_fin')
            ->paginate(15);

        return view('back.juridique.contrats.actifs', compact('contrats'));
    }

    public function expirants()
    {
        $contrats = Contrat::with('document.typeDocument')
            ->whereBetween('date_fin', [now(), now()->addDays(30)])
            ->orderBy('date_fin')
            ->paginate(15);

        return view('back.juridique.contrats.expirants', compact('contrats'));
    }

    public function expires()
    {
        $contrats = Contrat::with('document.typeDocument')
            ->where('date_fin', '<', now())
            ->orderBy('date_fin', 'desc')
            ->paginate(15);

        return view('back.juridique.contrats.expires', compact('contrats'));
    }

    public function create()
    {
        $documents = Document::with('typeDocument')
            ->whereDoesntHave('contrat')
            ->where('statut', 'valide')
            ->get();

        return view('back.juridique.contrats.create', compact('documents'));
    }

    public function store(ContratRequest $request)
    {
        $data = $request->validated();

        // Vérifier que le document existe et n'a pas déjà de contrat
        $document = Document::find($data['document_id']);
        if ($document->contrat) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Ce document a déjà un contrat associé.');
        }

        $contrat = Contrat::create($data);

        // Mettre à jour le document
        $document->update([
            'statut' => 'valide',
            'date_effet' => $contrat->date_debut,
            'date_expiration' => $contrat->date_fin
        ]);

        return redirect()
            ->route('back.juridique.contrats.show', $contrat)
            ->with('success', 'Contrat créé avec succès.');
    }

    public function show(Contrat $contrat)
    {
        $contrat->load(['document.typeDocument', 'document.signatures.user']);

        $statistiques = [
            'signatures_completes' => $contrat->document->signatures()->where('statut', 'signe')->count(),
            'signatures_attendues' => $contrat->document->signatures()->where('statut', 'en_attente')->count(),
            'jours_restants' => $contrat->date_fin ? now()->diffInDays($contrat->date_fin, false) : null
        ];

        return view('back.juridique.contrats.show', compact('contrat', 'statistiques'));
    }

    public function edit(Contrat $contrat)
    {
        $documents = Document::with('typeDocument')
            ->whereDoesntHave('contrat')
            ->orWhere('id', $contrat->document_id)
            ->where('statut', 'valide')
            ->get();

        return view('back.juridique.contrats.edit', compact('contrat', 'documents'));
    }

    public function update(ContratRequest $request, Contrat $contrat)
    {
        $data = $request->validated();

        $contrat->update($data);

        // Mettre à jour le document associé
        $contrat->document->update([
            'date_effet' => $contrat->date_debut,
            'date_expiration' => $contrat->date_fin
        ]);

        return redirect()
            ->route('back.juridique.contrats.show', $contrat)
            ->with('success', 'Contrat mis à jour avec succès.');
    }

    public function destroy(Contrat $contrat)
    {
        $contrat->delete();

        return redirect()
            ->route('back.juridique.contrats.index')
            ->with('success', 'Contrat supprimé avec succès.');
    }

    public function renouveler(Contrat $contrat)
    {
        if (!$contrat->renouvellement_auto) {
            return redirect()
                ->back()
                ->with('error', 'Ce contrat n\'est pas renouvelable automatiquement.');
        }

        $contrat->renouveler();

        return redirect()
            ->back()
            ->with('success', 'Contrat renouvelé avec succès.');
    }

    public function export(Request $request, Contrat $contrat)
    {
        $format = $request->get('format', 'pdf');

        if ($format === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('back.juridique.contrats.pdf', compact('contrat'));
            return $pdf->download("contrat_{$contrat->reference}.pdf");
        }

        // Export Excel
        $data = [
            ['Référence', $contrat->reference],
            ['Type', $contrat->type_contrat_label],
            ['Date début', $contrat->date_debut->format('d/m/Y')],
            ['Date fin', $contrat->date_fin ? $contrat->date_fin->format('d/m/Y') : 'Indéterminée'],
            ['Montant', $contrat->montant ? number_format($contrat->montant, 2) . ' ' . $contrat->devise : 'Non défini'],
        ];

        // Générer CSV
        $filename = "contrat_{$contrat->reference}.csv";
        $handle = fopen('php://temp', 'w+');
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
