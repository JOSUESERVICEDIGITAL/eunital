<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\DeploiementCouverture;

class DeploiementCouvertureController extends Controller
{
    public function index()
    {
        $couvertures = DeploiementCouverture::with('deploiement')->paginate(15);

        return view('back.innovations.deploiement-couvertures.index', compact('couvertures'));
    }

    public function carte()
    {
        $zones = DeploiementCouverture::all();

        return view('back.innovations.deploiement-couvertures.carte', compact('zones'));
    }
}
