@extends('back.layouts.principal')

@section('title', 'Modifier dépôt / version')
@section('page_title', 'Chambre développement · Modifier un dépôt / version')
@section('page_subtitle', 'Mise à jour du dépôt, de la branche, du statut de livraison et de la version actuelle.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.depots-versions.mettre_a_jour', $depotVersion) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-developpement.depots-versions._formulaire', [
                'depotVersion' => $depotVersion,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-developpement.depots-versions.details', $depotVersion) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection
