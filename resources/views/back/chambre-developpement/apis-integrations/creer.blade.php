@extends('back.layouts.principal')

@section('title', 'Nouvelle API / intégration')
@section('page_title', 'Chambre développement · Nouvelle API / intégration')
@section('page_subtitle', 'Création d’un service REST, GraphQL, webhook, SDK ou connecteur technique.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.apis-integrations.enregistrer') }}">
            @csrf

            @include('back.chambre-developpement.apis-integrations._formulaire', [
                'apiIntegration' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-developpement.apis-integrations.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection
