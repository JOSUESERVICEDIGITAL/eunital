<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\ImpactRapport;

class ImpactRapportController extends Controller
{
    public function index()
    {
        $rapports = ImpactRapport::with('impact')->paginate(15);

        return view('back.innovations.impact-rapports.index', compact('rapports'));
    }
}
