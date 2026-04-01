@extends('back.layouts.principal')

@section('title', 'Détails croissance')
@section('page_title', 'Chambre marketing · Détails croissance')
@section('page_subtitle', 'Vue détaillée de l’objectif, des leviers, de la métrique cible et du plan d’exécution.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $croissanceMarketing->titre }}</h3>
                <p class="text-muted mb-0">
                    {{ $croissanceMarketing->objectif ?: 'Aucun objectif renseigné.' }}
                </p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-marketing.croissances.modifier', $croissanceMarketing) }}"
                    class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>

                @if($croissanceMarketing->statut !== 'en_cours')
                    <form method="POST" action="{{ route('back.chambre-marketing.croissances.lancer', $croissanceMarketing) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Lancer
                        </button>
                    </form>
                @endif

                @if($croissanceMarketing->statut !== 'test')
                    <form method="POST"
                        action="{{ route('back.chambre-marketing.croissances.passer_en_test', $croissanceMarketing) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-info rounded-pill px-4">
                            Passer en test
                        </button>
                    </form>
                @endif

                @if($croissanceMarketing->statut !== 'validee')
                    <form method="POST"
                        action="{{ route('back.chambre-marketing.croissances.valider', $croissanceMarketing) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            Valider
                        </button>
                    </form>
                @endif

                @if($croissanceMarketing->statut !== 'abandonnee')
                    <form method="POST"
                        action="{{ route('back.chambre-marketing.croissances.abandonner', $croissanceMarketing) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-warning rounded-pill px-4">
                            Abandonner
                        </button>
                    </form>
                @endif

                @if($croissanceMarketing->priorite !== 'critique')
                    <form method="POST"
                        action="{{ route('back.chambre-marketing.croissances.definir_priorite_critique', $croissanceMarketing) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            Priorité critique
                        </button>
                    </form>
                @endif

                <form method="POST"
                    action="{{ route('back.chambre-marketing.croissances.archiver', $croissanceMarketing) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                        Archiver
                    </button>
                </form>

                <form method="POST"
                    action="{{ route('back.chambre-marketing.croissances.supprimer', $croissanceMarketing) }}"
                    onsubmit="return confirm('Supprimer cette action de croissance ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Levier</span>
                    <div class="fw-bold mt-2">{{ $croissanceMarketing->levier ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Métrique cible</span>
                    <div class="fw-bold mt-2">{{ $croissanceMarketing->metrique_cible ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($croissanceMarketing->statut)) }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Priorité</span>
                    <div class="fw-bold mt-2">{{ ucfirst($croissanceMarketing->priorite) }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Date début</span>
                    <div class="fw-bold mt-2">
                        {{ $croissanceMarketing->date_debut ? $croissanceMarketing->date_debut->format('d/m/Y') : '—' }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Date fin</span>
                    <div class="fw-bold mt-2">
                        {{ $croissanceMarketing->date_fin ? $croissanceMarketing->date_fin->format('d/m/Y') : '—' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Auteur</span>
                    <div class="fw-bold mt-2">{{ $croissanceMarketing->auteur->name ?? '—' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Responsable</span>
                    <div class="fw-bold mt-2">{{ $croissanceMarketing->responsable->name ?? '—' }}</div>
                </div>
            </div>

            <div class="col-12">
                <div class="detail-zone">
                    <strong>Action prévue</strong><br>
                    {{ $croissanceMarketing->action_prevue ?: 'Non renseignée.' }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile,
        .detail-zone {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            white-space: pre-line;
        }
    </style>
@endsection