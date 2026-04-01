@extends('back.layouts.principal')

@section('title', 'Détails campagne marketing')
@section('page_title', 'Chambre marketing · Détails campagne')
@section('page_subtitle', 'Vue détaillée de la campagne, du budget, de la diffusion et des actions rapides.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $campagneMarketing->titre }}</h3>
                        <p class="text-muted mb-0">{{ $campagneMarketing->description ?: 'Aucune description.' }}</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
    <a href="{{ route('back.chambre-marketing.campagnes.modifier', $campagneMarketing) }}"
       class="btn btn-warning rounded-pill px-4">
        Modifier
    </a>

    @if($campagneMarketing->statut !== 'active')
        <form method="POST" action="{{ route('back.chambre-marketing.campagnes.activer', $campagneMarketing) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success rounded-pill px-4">
                Activer la pub
            </button>
        </form>
    @endif

    @if($campagneMarketing->statut !== 'en_pause')
        <form method="POST" action="{{ route('back.chambre-marketing.campagnes.mettre_en_pause', $campagneMarketing) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-warning rounded-pill px-4">
                Mettre en pause
            </button>
        </form>
    @endif

    @if($campagneMarketing->statut === 'en_pause')
        <form method="POST" action="{{ route('back.chambre-marketing.campagnes.reprendre', $campagneMarketing) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-info rounded-pill px-4">
                Relancer
            </button>
        </form>
    @endif

    @if($campagneMarketing->statut !== 'terminee')
        <form method="POST" action="{{ route('back.chambre-marketing.campagnes.terminer', $campagneMarketing) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                Clôturer
            </button>
        </form>
    @endif

    <form method="POST" action="{{ route('back.chambre-marketing.campagnes.augmenter_budget', $campagneMarketing) }}">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-primary rounded-pill px-4">
            + Budget
        </button>
    </form>

    <form method="POST" action="{{ route('back.chambre-marketing.campagnes.diminuer_budget', $campagneMarketing) }}">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-outline-primary rounded-pill px-4">
            - Budget
        </button>
    </form>

    <form method="POST" action="{{ route('back.chambre-marketing.campagnes.dupliquer', $campagneMarketing) }}">
        @csrf
        <button type="submit" class="btn btn-dark rounded-pill px-4">
            Dupliquer
        </button>
    </form>

    <button type="button"
        class="btn btn-outline-primary rounded-pill px-4"
        data-bs-toggle="modal"
        data-bs-target="#modalActionsCampagne{{ $campagneMarketing->id }}">
        Centre d’actions
    </button>

    <button type="button"
        class="btn btn-outline-danger rounded-pill px-4"
        data-bs-toggle="modal"
        data-bs-target="#modalSuppressionCampagne{{ $campagneMarketing->id }}">
        Supprimer
    </button>
</div>
                </div>

                @include('back.chambre-marketing.campagnes._modales', ['campagne' => $campagneMarketing])

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">Réseau</span>
                            <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($campagneMarketing->reseau)) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">Objectif</span>
                            <div class="fw-bold mt-2">{{ $campagneMarketing->objectif ?: '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">Audience</span>
                            <div class="fw-bold mt-2">{{ $campagneMarketing->audience ?: '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Budget</span>
                            <div class="fw-bold mt-2">{{ number_format($campagneMarketing->budget, 2, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Consommé</span>
                            <div class="fw-bold mt-2">{{ number_format($campagneMarketing->budget_consomme, 2, ',', ' ') }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Conversion</span>
                            <div class="fw-bold mt-2">{{ $campagneMarketing->taux_conversion ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-tile">
                            <span class="text-muted small">Coût / résultat</span>
                            <div class="fw-bold mt-2">{{ $campagneMarketing->cout_par_resultat ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">Statut</span>
                            <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($campagneMarketing->statut)) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">Date début</span>
                            <div class="fw-bold mt-2">{{ $campagneMarketing->date_debut ? $campagneMarketing->date_debut->format('d/m/Y') : '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-tile">
                            <span class="text-muted small">Date fin</span>
                            <div class="fw-bold mt-2">{{ $campagneMarketing->date_fin ? $campagneMarketing->date_fin->format('d/m/Y') : '—' }}</div>
                        </div>
                    </div>
                </div>

                <div class="detail-zone mt-4">
                    <strong>Lien annonce</strong><br>
                    {{ $campagneMarketing->lien_annonce ?: 'Non renseigné.' }}
                </div>

                <div class="detail-zone mt-3">
                    <strong>Visuel</strong><br>
                    {{ $campagneMarketing->visuel ?: 'Non renseigné.' }}
                </div>
            </div>
        </div>

    </div>

    <style>
        .info-tile,.detail-zone{
            padding:18px;
            border-radius:18px;
            border:1px solid #e5e7eb;
            background:#f8fafc;
            white-space:pre-line;
        }
    </style>
@endsection
