@extends('back.layouts.principal')

@section('title', 'Modifier campagne marketing')
@section('page_title', 'Chambre marketing · Modifier campagne')
@section('page_subtitle', 'Mise à jour de la stratégie, du réseau, du budget et des paramètres de diffusion.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.campagnes.mettre_a_jour', $campagneMarketing) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-marketing.campagnes._formulaire', [
                'campagneMarketing' => $campagneMarketing,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-marketing.campagnes.details', $campagneMarketing) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection