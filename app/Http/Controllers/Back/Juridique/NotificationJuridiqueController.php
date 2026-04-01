<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Models\Juridique\NotificationJuridique;
use App\Models\Juridique\Document;
use App\Models\Juridique\Contrat;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationJuridiqueController extends Controller
{
    public function index()
    {
        $notifications = NotificationJuridique::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('back.juridique.notifications.index', compact('notifications'));
    }

    public function nonLues()
    {
        $notifications = NotificationJuridique::with('user')
            ->where('user_id', auth()->id())
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $notifications->count(),
            'notifications' => $notifications->map(fn($n) => [
                'id' => $n->id,
                'type' => $n->type,
                'message' => $n->message,
                'data' => $n->data,
                'created_at' => $n->created_at->diffForHumans()
            ])
        ]);
    }

    public function show(NotificationJuridique $notification)
    {
        $notification->load('user');

        if (!$notification->is_read) {
            $notification->update(['is_read' => true, 'read_at' => now()]);
        }

        return view('back.juridique.notifications.show', compact('notification'));
    }

    public function markAsRead(NotificationJuridique $notification)
    {
        $notification->update(['is_read' => true, 'read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        NotificationJuridique::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return redirect()
            ->back()
            ->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }

    public function destroy(NotificationJuridique $notification)
    {
        $notification->delete();

        return redirect()
            ->route('back.juridique.notifications.index')
            ->with('success', 'Notification supprimée avec succès.');
    }

    public function envoyerRappel(Contrat $contrat)
    {
        $users = $contrat->document->utilisateurs;

        foreach ($users as $user) {
            NotificationJuridique::create([
                'user_id' => $user->id,
                'type' => 'rappel_contrat',
                'message' => "Le contrat '{$contrat->reference}' expire le " . $contrat->date_fin->format('d/m/Y'),
                'data' => [
                    'contrat_id' => $contrat->id,
                    'document_id' => $contrat->document_id,
                    'date_expiration' => $contrat->date_fin
                ]
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Rappels envoyés avec succès.');
    }

    public function envoyerRappelSignature(Document $document)
    {
        $signatures = $document->signatures()->where('statut', 'en_attente')->get();

        foreach ($signatures as $signature) {
            NotificationJuridique::create([
                'user_id' => $signature->user_id,
                'type' => 'rappel_signature',
                'message' => "Veuillez signer le document '{$document->titre}'",
                'data' => [
                    'document_id' => $document->id,
                    'signature_id' => $signature->id
                ]
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Rappels de signature envoyés avec succès.');
    }

    public function preferences()
    {
        $preferences = auth()->user()->notification_preferences ?? [
            'nouveau_document' => true,
            'signature_requise' => true,
            'contrat_expiration' => true,
            'validation_document' => true,
            'rappel_hebdomadaire' => false
        ];

        return view('back.juridique.notifications.preferences', compact('preferences'));
    }

    public function updatePreferences(Request $request)
    {
        $request->validate([
            'nouveau_document' => 'nullable|boolean',
            'signature_requise' => 'nullable|boolean',
            'contrat_expiration' => 'nullable|boolean',
            'validation_document' => 'nullable|boolean',
            'rappel_hebdomadaire' => 'nullable|boolean'
        ]);

        auth()->user()->update([
            'notification_preferences' => $request->all()
        ]);

        return redirect()
            ->back()
            ->with('success', 'Préférences de notification mises à jour avec succès.');
    }

    public function envoyerRappelHebdomadaire()
    {
        $users = User::all();
        $count = 0;

        foreach ($users as $user) {
            $preferences = $user->notification_preferences ?? [];
            if (!($preferences['rappel_hebdomadaire'] ?? false)) {
                continue;
            }

            $documentsEnAttente = Document::where('cree_par', $user->id)
                ->where('statut', 'en_attente')
                ->count();

            $signaturesAttendues = Signature::where('user_id', $user->id)
                ->where('statut', 'en_attente')
                ->count();

            if ($documentsEnAttente > 0 || $signaturesAttendues > 0) {
                NotificationJuridique::create([
                    'user_id' => $user->id,
                    'type' => 'rappel_hebdomadaire',
                    'message' => "Résumé de votre activité juridique cette semaine",
                    'data' => [
                        'documents_en_attente' => $documentsEnAttente,
                        'signatures_attendues' => $signaturesAttendues
                    ]
                ]);
                $count++;
            }
        }

        return response()->json([
            'success' => true,
            'notifications_envoyees' => $count
        ]);
    }
}
