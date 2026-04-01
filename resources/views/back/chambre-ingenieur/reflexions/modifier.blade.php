@extends('back.layouts.principal')
@section('title', 'Modifier réflexion')
@section('page_title', 'Chambre d’ingénieurs · Modifier une réflexion')
@section('page_subtitle', 'Mise à jour du cadrage, de l’analyse et de l’orientation.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.reflexions.mettre_a_jour', $reflexionStrategique) }}">
            @csrf
            @method('PUT')
            @include('back.chambre-ingenieur.reflexions._formulaire', [
                'reflexionStrategique' => $reflexionStrategique,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-ingenieur.reflexions.details', $reflexionStrategique) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection