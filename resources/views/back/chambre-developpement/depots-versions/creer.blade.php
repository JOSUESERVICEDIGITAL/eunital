@extends('back.layouts.principal')

@section('title', 'Nouveau dépôt / version')
@section('page_title', 'Chambre développement · Nouveau dépôt / version')
@section('page_subtitle', 'Création d’un dépôt Git, d’une release, d’un hotfix ou d’un suivi de version.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.depots-versions.enregistrer') }}">
            @csrf

            @include('back.chambre-developpement.depots-versions._formulaire', [
                'depotVersion' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-developpement.depots-versions.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection
