<?php

namespace App\Http\Controllers\Back\ChambreStudio;

use Carbon\Carbon;
use App\Models\ClientStudio;
use App\Models\ReservationStudio;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerReservationStudioRequest;
use App\Http\Requests\ModifierReservationStudioRequest;

class ReservationStudioController extends Controller
{
    public function listeToutes()
    {
        $reservations = ReservationStudio::with('client')
            ->latest('date_debut')
            ->paginate(12);

        return view('back.chambre-studio.reservations.liste', compact('reservations'));
    }

    public function listeReservees()
    {
        $reservations = ReservationStudio::with('client')
            ->where('statut', 'reserve')
            ->latest('date_debut')
            ->paginate(12);

        return view('back.chambre-studio.reservations.reservees', compact('reservations'));
    }

    public function listeConfirmees()
    {
        $reservations = ReservationStudio::with('client')
            ->where('statut', 'confirme')
            ->latest('date_debut')
            ->paginate(12);

        return view('back.chambre-studio.reservations.confirmees', compact('reservations'));
    }

    public function listeAnnulees()
    {
        $reservations = ReservationStudio::with('client')
            ->where('statut', 'annule')
            ->latest('date_debut')
            ->paginate(12);

        return view('back.chambre-studio.reservations.annulees', compact('reservations'));
    }

    public function listeAujourdhui()
    {
        $reservations = ReservationStudio::with('client')
            ->whereDate('date_debut', Carbon::today())
            ->latest('date_debut')
            ->paginate(12);

        return view('back.chambre-studio.reservations.aujourdhui', compact('reservations'));
    }

    public function formulaireCreation()
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-studio.reservations.creer', compact('clients'));
    }

    public function enregistrer(EnregistrerReservationStudioRequest $request)
    {
        $reservationStudio = ReservationStudio::create($request->validated());

        return redirect()
            ->route('back.chambre-studio.reservations.details', $reservationStudio)
            ->with('success', 'Réservation studio enregistrée avec succès.');
    }

    public function details(ReservationStudio $reservationStudio)
    {
        $reservationStudio->load('client');

        return view('back.chambre-studio.reservations.details', compact('reservationStudio'));
    }

    public function formulaireEdition(ReservationStudio $reservationStudio)
    {
        $clients = ClientStudio::orderBy('nom')->get();

        return view('back.chambre-studio.reservations.modifier', compact('reservationStudio', 'clients'));
    }

    public function mettreAJour(ModifierReservationStudioRequest $request, ReservationStudio $reservationStudio)
    {
        $reservationStudio->update($request->validated());

        return redirect()
            ->route('back.chambre-studio.reservations.details', $reservationStudio)
            ->with('success', 'Réservation mise à jour avec succès.');
    }

    public function confirmer(ReservationStudio $reservationStudio)
    {
        $reservationStudio->update(['statut' => 'confirme']);

        return back()->with('success', 'Réservation confirmée.');
    }

    public function annuler(ReservationStudio $reservationStudio)
    {
        $reservationStudio->update(['statut' => 'annule']);

        return back()->with('success', 'Réservation annulée.');
    }

    public function supprimer(ReservationStudio $reservationStudio)
    {
        $reservationStudio->delete();

        return redirect()
            ->route('back.chambre-studio.reservations.toutes')
            ->with('success', 'Réservation supprimée avec succès.');
    }
}