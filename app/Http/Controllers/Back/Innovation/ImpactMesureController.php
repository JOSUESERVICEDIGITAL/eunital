<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\ImpactMesure;

class ImpactMesureController extends Controller
{
    public function index()
    {
        $mesures = ImpactMesure::with('impact')->paginate(15);

        return view('back.innovations.impact-mesures.index', compact('mesures'));
    }
}
