@extends('back.layouts.principal')

@section('title', 'Détails tableau de performance')
@section('page_title', 'Chambre marketing · Détails tableau de performance')
@section('page_subtitle', 'Vue détaillée des KPI marketing, des conversions, du ROAS et de la rentabilité.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $tableauPerformanceMarketing->titre }}</h3>
                        <p class="text-muted mb-0">
                            {{ $tableauPerformanceMarketing->campagne->titre ?? 'Aucune campagne liée.' }}
                        </p>
                    </div>

                   <div class="d-flex flex-wrap gap-2">
    <a href="{{ route('back.chambre-marketing.tableaux-performance.modifier', $tableauPerformanceMarketing) }}"
       class="btn btn-warning rounded-pill px-4">
        Modifier
    </a>

    @if($tableauPerformanceMarketing->statut !== 'publie')
        <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.publier', $tableauPerformanceMarketing) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success rounded-pill px-4">
                Publier
            </button>
        </form>
    @endif

    @if($tableauPerformanceMarketing->statut !== 'brouillon')
        <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.remettre_en_brouillon', $tableauPerformanceMarketing) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                Brouillon
            </button>
        </form>
    @endif

    <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.archiver', $tableauPerformanceMarketing) }}">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-outline-dark rounded-pill px-4">
            Archiver
        </button>
    </form>

    <button type="button"
        class="btn btn-outline-primary rounded-pill px-4"
        data-bs-toggle="modal"
        data-bs-target="#modalActionsTableau{{ $tableauPerformanceMarketing->id }}">
        Centre analytique
    </button>

    <button type="button"
        class="btn btn-outline-danger rounded-pill px-4"
        data-bs-toggle="modal"
        data-bs-target="#modalSuppressionTableau{{ $tableauPerformanceMarketing->id }}">
        Supprimer
    </button>
</div>
                @include('back.chambre-marketing.tableaux-performance._modales', ['tableauPerformanceMarketing' => $tableauPerformanceMarketing])

                </div>

                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Impressions</span>
                            <div class="fw-bold mt-2">{{ number_format($tableauPerformanceMarketing->impressions, 0, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Clics</span>
                            <div class="fw-bold mt-2">{{ number_format($tableauPerformanceMarketing->clics, 0, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Conversions</span>
                            <div class="fw-bold mt-2">{{ number_format($tableauPerformanceMarketing->conversions, 0, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Leads</span>
                            <div class="fw-bold mt-2">{{ number_format($tableauPerformanceMarketing->leads, 0, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Ventes</span>
                            <div class="fw-bold mt-2">{{ number_format($tableauPerformanceMarketing->ventes, 0, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">CTR</span>
                            <div class="fw-bold mt-2">{{ $tableauPerformanceMarketing->ctr ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">CPC</span>
                            <div class="fw-bold mt-2">{{ $tableauPerformanceMarketing->cpc ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">CPM</span>
                            <div class="fw-bold mt-2">{{ $tableauPerformanceMarketing->cpm ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">ROAS</span>
                            <div class="fw-bold mt-2">{{ $tableauPerformanceMarketing->roas ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">Coût total</span>
                            <div class="fw-bold mt-2">{{ number_format($tableauPerformanceMarketing->cout_total, 2, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">Revenu généré</span>
                            <div class="fw-bold mt-2">{{ number_format($tableauPerformanceMarketing->revenu_genere, 2, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Période début</span>
                            <div class="fw-bold mt-2">
                                {{ $tableauPerformanceMarketing->periode_debut ? $tableauPerformanceMarketing->periode_debut->format('d/m/Y') : '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Période fin</span>
                            <div class="fw-bold mt-2">
                                {{ $tableauPerformanceMarketing->periode_fin ? $tableauPerformanceMarketing->periode_fin->format('d/m/Y') : '—' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        .info-tile{
            padding:18px;
            border-radius:18px;
            border:1px solid #e5e7eb;
            background:#f8fafc;
        }
    </style>
@endsection
