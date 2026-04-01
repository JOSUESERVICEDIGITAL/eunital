@extends('back.layouts.principal')
@section('title', 'Modifier architecture')
@section('page_title', 'Chambre d’ingénieurs · Modifier une architecture')
@section('page_subtitle', 'Mise à jour des composants, contraintes, version et diagramme.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.architectures.mettre_a_jour', $architectureTechnique) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('back.chambre-ingenieur.architectures._formulaire', [
                'architectureTechnique' => $architectureTechnique,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-ingenieur.architectures.details', $architectureTechnique) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection