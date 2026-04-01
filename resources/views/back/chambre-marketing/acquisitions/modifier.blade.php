@extends('back.layouts.principal')

@section('title', 'Modifier acquisition')
@section('page_title', 'Chambre marketing · Modifier acquisition')
@section('page_subtitle', 'Mise à jour des sources, canaux, volumes, coûts et statut d’acquisition.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.acquisitions.mettre_a_jour', $acquisitionMarketing) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-marketing.acquisitions._formulaire', [
                'acquisitionMarketing' => $acquisitionMarketing,
                'utilisateurs' => $utilisateurs,
                'campagnes' => $campagnes
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-marketing.acquisitions.details', $acquisitionMarketing) }}" class="btn btn-outline-dark rounded-pill px-4">
                    Retour
                </a>
            </div>
        </form>
    </div>
@endsection