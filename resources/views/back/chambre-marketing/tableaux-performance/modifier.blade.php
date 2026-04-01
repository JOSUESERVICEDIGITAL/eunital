@extends('back.layouts.principal')

@section('title', 'Modifier tableau de performance')
@section('page_title', 'Chambre marketing · Modifier tableau de performance')
@section('page_subtitle', 'Mise à jour des KPI, des périodes, du ROAS, des coûts et des revenus.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.mettre_a_jour', $tableauPerformanceMarketing) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-marketing.tableaux-performance._formulaire', [
                'tableauPerformanceMarketing' => $tableauPerformanceMarketing,
                'utilisateurs' => $utilisateurs,
                'campagnes' => $campagnes
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-marketing.tableaux-performance.details', $tableauPerformanceMarketing) }}" class="btn btn-outline-dark rounded-pill px-4">
                    Retour
                </a>
            </div>
        </form>
    </div>
@endsection
