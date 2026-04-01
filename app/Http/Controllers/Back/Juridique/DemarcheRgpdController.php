<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\DemarcheRgpdRequest;
use App\Models\Juridique\DemarcheRgpd;
use Illuminate\Http\Request;

class DemarcheRgpdController extends Controller
{
    public function index()
    {
        $demarches = DemarcheRgpd::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.rgpd.index', compact('demarches'));
    }

    public function enCours()
    {
        $demarches = DemarcheRgpd::where('statut', 'en_cours')
            ->orderBy('date_limite', 'asc')
            ->paginate(15);

        return view('back.juridique.rgpd.en-cours', compact('demarches'));
    }

    public function realisees()
    {
        $demarches = DemarcheRgpd::where('statut', 'realise')
            ->orderBy('date_realisation', 'desc')
            ->paginate(15);

        return view('back.juridique.rgpd.realisees', compact('demarches'));
    }

    public function create()
    {
        $types = $this->getTypes();

        return view('back.juridique.rgpd.create', compact('types'));
    }

    public function store(DemarcheRgpdRequest $request)
    {
        $data = $request->validated();
        $demarche = DemarcheRgpd::create($data);

        return redirect()
            ->route('back.juridique.rgpd.show', $demarche)
            ->with('success', 'Démarche RGPD créée avec succès.');
    }

    public function show(DemarcheRgpd $demarcheRgpd)
    {
        return view('back.juridique.rgpd.show', compact('demarcheRgpd'));
    }

    public function edit(DemarcheRgpd $demarcheRgpd)
    {
        $types = $this->getTypes();

        return view('back.juridique.rgpd.edit', compact('demarcheRgpd', 'types'));
    }

    public function update(DemarcheRgpdRequest $request, DemarcheRgpd $demarcheRgpd)
    {
        $demarcheRgpd->update($request->validated());

        return redirect()
            ->route('back.juridique.rgpd.show', $demarcheRgpd)
            ->with('success', 'Démarche RGPD mise à jour avec succès.');
    }

    public function destroy(DemarcheRgpd $demarcheRgpd)
    {
        $demarcheRgpd->delete();

        return redirect()
            ->route('back.juridique.rgpd.index')
            ->with('success', 'Démarche RGPD supprimée avec succès.');
    }

    public function valider(DemarcheRgpd $demarcheRgpd)
    {
        $demarcheRgpd->valider();

        return redirect()
            ->back()
            ->with('success', 'Démarche RGPD validée avec succès.');
    }

    public function registre()
    {
        $registres = DemarcheRgpd::where('type', 'registre_traitement')
            ->where('statut', 'realise')
            ->get();

        return view('back.juridique.rgpd.registre', compact('registres'));
    }

    private function getTypes()
    {
        return [
            'registre_traitement' => 'Registre des traitements',
            'analyse_impact' => 'Analyse d\'impact',
            'consentement' => 'Gestion des consentements',
            'notification_violation' => 'Notification de violation',
            'demande_droit' => 'Demande de droit',
            'information' => 'Information'
        ];
    }
}
