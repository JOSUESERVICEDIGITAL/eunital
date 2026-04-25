<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\ComiteParticipant;

class ComiteParticipantController extends Controller
{
    public function index()
    {
        $participants = ComiteParticipant::paginate(15);

        return view('back.innovations.comite-participants.index', compact('participants'));
    }
}
