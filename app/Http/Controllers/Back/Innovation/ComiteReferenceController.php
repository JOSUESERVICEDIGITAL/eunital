<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\ComiteReference;

class ComiteReferenceController extends Controller
{
    public function index()
    {
        $refs = ComiteReference::paginate(15);

        return view('back.innovations.comite-references.index', compact('refs'));
    }
}
