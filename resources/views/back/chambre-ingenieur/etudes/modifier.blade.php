@extends('back.layouts.principal')
@section('title', 'Modifier étude')
@section('page_title', 'Chambre d’ingénieurs · Modifier une étude')
@section('page_subtitle', 'Mise à jour de l’analyse de faisabilité et de la décision.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.etudes.mettre_a_jour', $etudeFaisabilite) }}">
            @csrf
            @method('PUT')
            @include('back.chambre-ingenieur.etudes._formulaire', [
                'etudeFaisabilite' => $etudeFaisabilite,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-ingenieur.etudes.details', $etudeFaisabilite) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection