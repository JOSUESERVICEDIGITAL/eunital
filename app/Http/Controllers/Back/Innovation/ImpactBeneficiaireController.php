<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\ImpactBeneficiaire;

class ImpactBeneficiaireController extends Controller
{
    public function index()
    {
        $beneficiaires = ImpactBeneficiaire::with('impact')->paginate(15);

        return view('back.innovations.impact-beneficiaires.index', compact('beneficiaires'));
    }
}
