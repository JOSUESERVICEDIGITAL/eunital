@extends('back.layouts.principal')

@section('title', 'Nouvelle campagne marketing')
@section('page_title', 'Chambre marketing · Nouvelle campagne')
@section('page_subtitle', 'Création d’une nouvelle diffusion publicitaire multi-plateformes.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.campagnes.enregistrer') }}">
            @csrf

            @include('back.chambre-marketing.campagnes._formulaire', [
                'campagneMarketing' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-marketing.campagnes.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection