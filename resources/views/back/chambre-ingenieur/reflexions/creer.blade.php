@extends('back.layouts.principal')
@section('title', 'Nouvelle réflexion')
@section('page_title', 'Chambre d’ingénieurs · Nouvelle réflexion stratégique')
@section('page_subtitle', 'Création d’une note de réflexion et d’orientation stratégique.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.reflexions.enregistrer') }}">
            @csrf
            @include('back.chambre-ingenieur.reflexions._formulaire', [
                'reflexionStrategique' => null,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-ingenieur.reflexions.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection