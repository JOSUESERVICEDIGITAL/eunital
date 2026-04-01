@extends('back.layouts.principal')
@section('title', 'Nouveau prototype')
@section('page_title', 'Chambre d’ingénieurs · Nouveau prototype')
@section('page_subtitle', 'Création d’un POC, d’une maquette ou d’un MVP expérimental.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.prototypes.enregistrer') }}" enctype="multipart/form-data">
            @csrf
            @include('back.chambre-ingenieur.prototypes._formulaire', [
                'prototypeIngenieurie' => null,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-ingenieur.prototypes.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection