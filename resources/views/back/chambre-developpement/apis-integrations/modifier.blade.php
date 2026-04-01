@extends('back.layouts.principal')

@section('title', 'Modifier API / intégration')
@section('page_title', 'Chambre développement · Modifier une API / intégration')
@section('page_subtitle', 'Mise à jour du service, de l’authentification, du statut et des URLs techniques.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.apis-integrations.mettre_a_jour', $apiIntegration) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-developpement.apis-integrations._formulaire', [
                'apiIntegration' => $apiIntegration,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-developpement.apis-integrations.details', $apiIntegration) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection
