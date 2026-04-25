<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\ComiteSession;

class ComiteSessionController extends Controller
{
    public function index()
    {
        $sessions = ComiteSession::with('comite')->paginate(15);

        return view('back.innovations.comite-sessions.index', compact('sessions'));
    }

    public function cloturer(ComiteSession $session)
    {
        $session->update(['statut' => 'cloturee']);

        return back()->with('success', 'Session clôturée');
    }
}
