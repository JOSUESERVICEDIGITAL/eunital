@extends('back.layouts.principal')

@section('title', 'Tableaux de performance')
@section('page_title', 'Chambre marketing · Tableaux de performance')
@section('page_subtitle', 'Suivi des KPI marketing, clics, impressions, conversions, coûts, revenus et rentabilité.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            @include('back.chambre-marketing.tableaux-performance._graphiques', [
                'tableaux' => $tableaux
            ])
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Centre de performance marketing</h4>
                        <p class="text-muted mb-0">Analyse les résultats, compare les campagnes, pilote le ROAS, les coûts et les revenus générés.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-marketing.tableaux-performance.tous') }}" class="btn btn-outline-dark rounded-pill px-4">
                            Tous
                        </a>

                        <a href="{{ route('back.chambre-marketing.tableaux-performance.publies') }}" class="btn btn-outline-success rounded-pill px-4">
                            Publiés
                        </a>

                        <a href="{{ route('back.chambre-marketing.tableaux-performance.brouillons') }}" class="btn btn-outline-warning rounded-pill px-4">
                            Brouillons
                        </a>

                        <a href="{{ route('back.chambre-marketing.tableaux-performance.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-1"></i> Nouveau tableau
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.chambre-marketing.tableaux-performance._table', [
                'tableaux' => $tableaux,
                'titreBloc' => 'Tous les tableaux de performance',
                'descriptionBloc' => 'Vue consolidée des performances marketing par période ou campagne.'
            ])
        </div>

    </div>
@endsection