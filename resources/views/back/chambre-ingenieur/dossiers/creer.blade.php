@extends('back.layouts.principal')
@section('title', 'Nouveau dossier')
@section('page_title', 'Chambre d’ingénieurs · Nouveau dossier technique')
@section('page_subtitle', 'Création d’un document technique, procédure, manuel ou spécification.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.dossiers.enregistrer') }}" enctype="multipart/form-data">
            @csrf
            @include('back.chambre-ingenieur.dossiers._formulaire', [
                'dossierTechnique' => null,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-ingenieur.dossiers.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection