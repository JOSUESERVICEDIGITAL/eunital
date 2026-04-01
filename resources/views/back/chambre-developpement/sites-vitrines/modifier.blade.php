@extends('back.layouts.principal')

@section('title', 'Modifier site vitrine')
@section('page_title', 'Chambre développement · Modifier un site vitrine')
@section('page_subtitle', 'Mise à jour du projet, du client, du statut et des technologies utilisées.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.sites-vitrines.mettre_a_jour', $siteVitrine) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-developpement.sites-vitrines._formulaire', [
                'siteVitrine' => $siteVitrine,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-developpement.sites-vitrines.details', $siteVitrine) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection
