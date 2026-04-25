<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\SuiviBlocage;

class SuiviBlocageController extends Controller
{
    public function index()
    {
        $blocages = SuiviBlocage::with('suivi')->paginate(15);

        return view('back.innovations.suivi-blocages.index', compact('blocages'));
    }

    public function lever(SuiviBlocage $blocage)
    {
        $blocage->update(['statut' => 'resolu']);

        return back()->with('success', 'Blocage levé');
    }
}
