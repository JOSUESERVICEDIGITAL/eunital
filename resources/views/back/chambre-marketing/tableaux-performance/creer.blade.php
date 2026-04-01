@extends('back.layouts.principal')

@section('title', 'Nouveau tableau de performance')
@section('page_title', 'Chambre marketing · Nouveau tableau de performance')
@section('page_subtitle', 'Création d’un nouveau tableau KPI pour le suivi analytique marketing.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.enregistrer') }}">
            @csrf

            @include('back.chambre-marketing.tableaux-performance._formulaire', [
                'tableauPerformanceMarketing' => null,
                'utilisateurs' => $utilisateurs,
                'campagnes' => $campagnes
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-marketing.tableaux-performance.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection
