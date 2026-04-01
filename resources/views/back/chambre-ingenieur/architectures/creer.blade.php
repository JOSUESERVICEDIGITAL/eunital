@extends('back.layouts.principal')
@section('title', 'Nouvelle architecture')
@section('page_title', 'Chambre d’ingénieurs · Nouvelle architecture technique')
@section('page_subtitle', 'Création d’une structure technique, d’un schéma ou d’une conception système.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.architectures.enregistrer') }}" enctype="multipart/form-data">
            @csrf
            @include('back.chambre-ingenieur.architectures._formulaire', [
                'architectureTechnique' => null,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-ingenieur.architectures.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection