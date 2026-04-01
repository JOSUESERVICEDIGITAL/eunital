@extends('back.layouts.principal')
@section('title', 'Modifier prototype')
@section('page_title', 'Chambre d’ingénieurs · Modifier un prototype')
@section('page_subtitle', 'Mise à jour de l’état, de l’objectif et des liens du prototype.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.prototypes.mettre_a_jour', $prototypeIngenieurie) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('back.chambre-ingenieur.prototypes._formulaire', [
                'prototypeIngenieurie' => $prototypeIngenieurie,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-ingenieur.prototypes.details', $prototypeIngenieurie) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection