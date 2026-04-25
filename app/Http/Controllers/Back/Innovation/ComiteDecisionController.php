<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\ComiteDecision;

class ComiteDecisionController extends Controller
{
    public function index()
    {
        $decisions = ComiteDecision::with('session')->paginate(15);

        return view('back.innovations.comite-decisions.index', compact('decisions'));
    }
}
