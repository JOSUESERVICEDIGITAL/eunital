<?php

namespace App\Http\Controllers\Back\Equipe;

use App\Models\Departement;
use App\Models\MembreEquipe;
use App\Models\MessageInterne;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerMessageInterneRequest;
use App\Http\Requests\ModifierMessageInterneRequest;

class MessageInterneController extends Controller
{
    public function listeTous()
    {
        $messages = MessageInterne::with(['expediteur', 'destinataire', 'departement'])
            ->latest()
            ->paginate(12);

        return view('back.equipe.messages.liste', compact('messages'));
    }

    public function listeRecus()
    {
        $messages = MessageInterne::with(['expediteur', 'destinataire', 'departement'])
            ->whereNotNull('destinataire_id')
            ->latest()
            ->paginate(12);

        return view('back.equipe.messages.recus', compact('messages'));
    }

    public function listeEnvoyes()
    {
        $messages = MessageInterne::with(['expediteur', 'destinataire', 'departement'])
            ->latest()
            ->paginate(12);

        return view('back.equipe.messages.envoyes', compact('messages'));
    }

    public function listeAnnonces()
    {
        $messages = MessageInterne::with(['expediteur', 'destinataire', 'departement'])
            ->where('type_message', 'annonce')
            ->latest()
            ->paginate(12);

        return view('back.equipe.messages.annonces', compact('messages'));
    }

    public function formulaireCreation()
    {
        $membres = MembreEquipe::orderBy('nom')->orderBy('prenom')->get();
        $departements = Departement::orderBy('nom')->get();

        return view('back.equipe.messages.creer', compact('membres', 'departements'));
    }

    public function enregistrer(EnregistrerMessageInterneRequest $request)
    {
        $donnees = $request->validated();

        $message = MessageInterne::create([
            'expediteur_id' => $donnees['expediteur_id'],
            'destinataire_id' => $donnees['destinataire_id'] ?? null,
            'departement_id' => $donnees['departement_id'] ?? null,
            'sujet' => $donnees['sujet'],
            'contenu' => $donnees['contenu'],
            'type_message' => $donnees['type_message'],
            'est_lu' => $request->boolean('est_lu', false),
            'date_envoi' => $donnees['date_envoi'] ?? now(),
        ]);

        return redirect()
            ->route('back.equipe.messages.details', $message)
            ->with('success', 'Message interne envoyé avec succès.');
    }

    public function details(MessageInterne $messageInterne)
    {
        $messageInterne->load(['expediteur', 'destinataire', 'departement']);

        return view('back.equipe.messages.details', compact('messageInterne'));
    }

    public function formulaireEdition(MessageInterne $messageInterne)
    {
        $membres = MembreEquipe::orderBy('nom')->orderBy('prenom')->get();
        $departements = Departement::orderBy('nom')->get();

        return view('back.equipe.messages.modifier', compact('messageInterne', 'membres', 'departements'));
    }

    public function mettreAJour(ModifierMessageInterneRequest $request, MessageInterne $messageInterne)
    {
        $donnees = $request->validated();

        $messageInterne->update([
            'expediteur_id' => $donnees['expediteur_id'],
            'destinataire_id' => $donnees['destinataire_id'] ?? null,
            'departement_id' => $donnees['departement_id'] ?? null,
            'sujet' => $donnees['sujet'],
            'contenu' => $donnees['contenu'],
            'type_message' => $donnees['type_message'],
            'est_lu' => $request->boolean('est_lu', false),
            'date_envoi' => $donnees['date_envoi'] ?? $messageInterne->date_envoi,
        ]);

        return back()->with('success', 'Message interne mis à jour avec succès.');
    }

    public function marquerCommeLu(MessageInterne $messageInterne)
    {
        $messageInterne->update([
            'est_lu' => true,
        ]);

        return back()->with('success', 'Le message a été marqué comme lu.');
    }

    public function marquerCommeNonLu(MessageInterne $messageInterne)
    {
        $messageInterne->update([
            'est_lu' => false,
        ]);

        return back()->with('success', 'Le message a été marqué comme non lu.');
    }

    public function supprimer(MessageInterne $messageInterne)
    {
        $messageInterne->delete();

        return redirect()
            ->route('back.equipe.messages.tous')
            ->with('success', 'Message interne supprimé avec succès.');
    }
}