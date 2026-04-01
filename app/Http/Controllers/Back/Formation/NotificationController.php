<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\NotificationRequest;
use App\Models\Formation\NotificationFormation;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = NotificationFormation::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.notifications.index', compact('notifications'));
    }

    public function nonLues()
    {
        $notifications = NotificationFormation::with('user')
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('back.formation.notifications.non-lues', compact('notifications'));
    }

    public function create()
    {
        $utilisateurs = User::orderBy('name')->get();
        $types = [
            'cours_debut' => 'Début de cours',
            'devoir_limite' => 'Limite de devoir',
            'presence' => 'Présence',
            'soumission_recue' => 'Soumission reçue',
            'devoir_corrige' => 'Devoir corrigé',
            'rappel' => 'Rappel',
            'annonce' => 'Annonce'
        ];
        
        return view('back.formation.notifications.create', compact('utilisateurs', 'types'));
    }

    public function store(NotificationRequest $request)
    {
        $data = $request->validated();
        
        // Si user_id est null, envoyer à tous les utilisateurs
        if (is_null($data['user_id'])) {
            $users = User::all();
            foreach ($users as $user) {
                NotificationFormation::create([
                    'user_id' => $user->id,
                    'type' => $data['type'],
                    'message' => $data['message'],
                    'data' => $data['data'] ?? null
                ]);
            }
            
            return redirect()
                ->route('back.formation.notifications.index')
                ->with('success', 'Notification envoyée à tous les utilisateurs.');
        }
        
        $notification = NotificationFormation::create($data);
        
        return redirect()
            ->route('back.formation.notifications.show', $notification)
            ->with('success', 'Notification créée avec succès.');
    }

    public function show(NotificationFormation $notification)
    {
        $notification->load('user');
        
        // Marquer comme lue si ce n'est pas déjà fait
        if (!$notification->is_read) {
            $notification->marquerCommeLue();
        }
        
        return view('back.formation.notifications.show', compact('notification'));
    }

    public function edit(NotificationFormation $notification)
    {
        $utilisateurs = User::orderBy('name')->get();
        $types = [
            'cours_debut' => 'Début de cours',
            'devoir_limite' => 'Limite de devoir',
            'presence' => 'Présence',
            'soumission_recue' => 'Soumission reçue',
            'devoir_corrige' => 'Devoir corrigé',
            'rappel' => 'Rappel',
            'annonce' => 'Annonce'
        ];
        
        return view('back.formation.notifications.edit', compact('notification', 'utilisateurs', 'types'));
    }

    public function update(NotificationRequest $request, NotificationFormation $notification)
    {
        $notification->update($request->validated());
        
        return redirect()
            ->route('back.formation.notifications.show', $notification)
            ->with('success', 'Notification mise à jour avec succès.');
    }

    public function destroy(NotificationFormation $notification)
    {
        $notification->delete();
        
        return redirect()
            ->route('back.formation.notifications.index')
            ->with('success', 'Notification supprimée avec succès.');
    }

    public function marquerLue(NotificationFormation $notification)
    {
        $notification->marquerCommeLue();
        
        return response()->json([
            'success' => true,
            'is_read' => true
        ]);
    }

    public function marquerToutesLues()
    {
        NotificationFormation::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        
        return redirect()
            ->back()
            ->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }

    public function envoyerRappel($devoirId)
    {
        $devoir = \App\Models\Formation\Devoir::findOrFail($devoirId);
        $etudiants = $devoir->cour->utilisateurs;
        
        foreach ($etudiants as $etudiant) {
            // Vérifier si l'étudiant a déjà soumis
            $soumission = \App\Models\Formation\SoumissionDevoir::where('devoir_id', $devoirId)
                ->where('user_id', $etudiant->id)
                ->first();
            
            if (!$soumission && $devoir->date_limite && $devoir->date_limite > now()) {
                NotificationFormation::create([
                    'user_id' => $etudiant->id,
                    'type' => 'rappel',
                    'message' => "Rappel: Le devoir '{$devoir->titre}' est à rendre avant le " . $devoir->date_limite->format('d/m/Y H:i'),
                    'data' => [
                        'devoir_id' => $devoir->id,
                        'date_limite' => $devoir->date_limite
                    ]
                ]);
            }
        }
        
        return redirect()
            ->back()
            ->with('success', 'Rappels envoyés aux étudiants n\'ayant pas encore soumis.');
    }
}