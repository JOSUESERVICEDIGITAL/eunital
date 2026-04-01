@extends('back.layouts.principal')

@section('title', 'Détails acquisition')
@section('page_title', 'Chambre marketing · Détails acquisition')
@section('page_subtitle', 'Vue détaillée des visiteurs, leads, coûts, canal et performance d’acquisition.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $acquisitionMarketing->titre }}</h3>
                <p class="text-muted mb-0">
                    {{ $acquisitionMarketing->source ?: 'Source non renseignée.' }}
                </p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-marketing.acquisitions.modifier', $acquisitionMarketing) }}"
                    class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>

                @if($acquisitionMarketing->statut !== 'active')
                    <form method="POST"
                        action="{{ route('back.chambre-marketing.acquisitions.activer', $acquisitionMarketing) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            Activer
                        </button>
                    </form>
                @endif

                @if($acquisitionMarketing->statut !== 'optimisation')
                    <form method="POST"
                        action="{{ route('back.chambre-marketing.acquisitions.optimiser', $acquisitionMarketing) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-primary rounded-pill px-4">
                            Optimiser
                        </button>
                    </form>
                @endif

                @if($acquisitionMarketing->statut !== 'stoppee')
                    <form method="POST"
                        action="{{ route('back.chambre-marketing.acquisitions.stopper', $acquisitionMarketing) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-warning rounded-pill px-4">
                            Stopper
                        </button>
                    </form>
                @endif

                <form method="POST"
                    action="{{ route('back.chambre-marketing.acquisitions.archiver', $acquisitionMarketing) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                        Archiver
                    </button>
                </form>

                <button type="button" class="btn btn-outline-primary rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#modalActionsAcquisition{{ $acquisitionMarketing->id }}">
                    Centre d’actions
                </button>

                <button type="button" class="btn btn-outline-danger rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionAcquisition{{ $acquisitionMarketing->id }}">
                    Supprimer
                </button>
            </div>
            @include('back.chambre-marketing.acquisitions._modales', ['acquisition' => $acquisition])

        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Campagne liée</span>
                    <div class="fw-bold mt-2">{{ $acquisitionMarketing->campagne->titre ?? '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Canal</span>
                    <div class="fw-bold mt-2">{{ $acquisitionMarketing->canal ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ ucfirst($acquisitionMarketing->statut) }}</div>
                </div>
            </div>
            <td class="text-end">
                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                    <a href="{{ route('back.chambre-marketing.acquisitions.details', $acquisition) }}"
                        class="btn btn-sm btn-light rounded-pill px-3">
                        Voir
                    </a>

                    <a href="{{ route('back.chambre-marketing.acquisitions.modifier', $acquisition) }}"
                        class="btn btn-sm btn-warning rounded-pill px-3">
                        Modifier
                    </a>

                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal"
                        data-bs-target="#modalActionsAcquisition{{ $acquisition->id }}">
                        Actions
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" data-bs-toggle="modal"
                        data-bs-target="#modalSuppressionAcquisition{{ $acquisition->id }}">
                        Supprimer
                    </button>
                </div>

            </td>

            <div class="col-md-3">
                <div class="info-tile">
                    <span class="text-muted small">Visiteurs</span>
                    <div class="fw-bold mt-2">{{ number_format($acquisitionMarketing->visiteurs, 0, ',', ' ') }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-tile">
                    <span class="text-muted small">Leads</span>
                    <div class="fw-bold mt-2">{{ number_format($acquisitionMarketing->leads, 0, ',', ' ') }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-tile">
                    <span class="text-muted small">Coût acquisition</span>
                    <div class="fw-bold mt-2">{{ number_format($acquisitionMarketing->cout_acquisition, 2, ',', ' ') }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-tile">
                    <span class="text-muted small">Taux conversion</span>
                    <div class="fw-bold mt-2">{{ $acquisitionMarketing->taux_conversion ?? '—' }}</div>
                </div>
            </div>
        </div>
        @include('back.chambre-marketing.acquisitions._modales', ['acquisitionMarketing' => $acquisitionMarketing])
    </div>

    <style>
        .info-tile {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
        }
    </style>
@endsection