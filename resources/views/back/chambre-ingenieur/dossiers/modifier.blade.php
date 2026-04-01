@extends('back.layouts.principal')
@section('title', 'Modifier dossier')
@section('page_title', 'Chambre d’ingénieurs · Modifier un dossier technique')
@section('page_subtitle', 'Mise à jour du contenu, du statut et du document principal.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.dossiers.mettre_a_jour', $dossierTechnique) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('back.chambre-ingenieur.dossiers._formulaire', [
                'dossierTechnique' => $dossierTechnique,
                'utilisateurs' => $utilisateurs
            ])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-ingenieur.dossiers.details', $dossierTechnique) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection