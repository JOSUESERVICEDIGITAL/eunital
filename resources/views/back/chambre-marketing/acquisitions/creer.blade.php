@extends('back.layouts.principal')

@section('title', 'Nouvelle acquisition')
@section('page_title', 'Chambre marketing · Nouvelle acquisition')
@section('page_subtitle', 'Création d’une nouvelle source ou d’un nouveau canal d’acquisition marketing.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.acquisitions.enregistrer') }}">
            @csrf

            @include('back.chambre-marketing.acquisitions._formulaire', [
                'acquisitionMarketing' => null,
                'utilisateurs' => $utilisateurs,
                'campagnes' => $campagnes
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-marketing.acquisitions.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection