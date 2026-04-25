<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\DeploiementAdoption;

class DeploiementAdoptionController extends Controller
{
    public function index()
    {
        $adoptions = DeploiementAdoption::with('deploiement')->paginate(15);

        return view('back.innovations.deploiement-adoptions.index', compact('adoptions'));
    }

    public function stats()
    {
        $stats = [
            'total' => DeploiementAdoption::count(),
            'moyenne' => DeploiementAdoption::avg('taux_adoption'),
        ];

        return view('back.innovations.deploiement-adoptions.stats', compact('stats'));
    }
}
