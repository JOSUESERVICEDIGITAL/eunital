<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\AdoptionDetail;

class AdoptionDetailController extends Controller
{
    public function index()
    {
        $details = AdoptionDetail::with('adoption')->paginate(15);

        return view('back.innovations.adoption-details.index', compact('details'));
    }
}
