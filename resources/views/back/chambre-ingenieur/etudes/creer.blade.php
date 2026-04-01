@extends('back.layouts.principal')
@section('title', 'Nouvelle étude')
@section('page_title', 'Chambre d’ingénieurs · Nouvelle étude de faisabilité')
@section('page_subtitle', 'Création d’une étude de faisabilité technique, humaine et financière.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.etudes.enregistrer') }}">
            @csrf
            @include('back.chambre-ingenieur.etudes._formulaire', [
                'etudeFaisabilite' => null,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-ingenieur.etudes.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection