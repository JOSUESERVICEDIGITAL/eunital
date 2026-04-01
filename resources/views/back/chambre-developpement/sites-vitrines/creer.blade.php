@extends('back.layouts.principal')

@section('title', 'Nouveau site vitrine')
@section('page_title', 'Chambre développement · Nouveau site vitrine')
@section('page_subtitle', 'Création d’un nouveau site institutionnel, landing page ou vitrine commerciale.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.sites-vitrines.enregistrer') }}">
            @csrf

            @include('back.chambre-developpement.sites-vitrines._formulaire', [
                'siteVitrine' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-developpement.sites-vitrines.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection
