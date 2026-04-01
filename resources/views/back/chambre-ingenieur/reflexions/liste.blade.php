@extends('back.layouts.principal')

@section('title', 'Réflexions stratégiques')
@section('page_title', 'Chambre d’ingénieurs · Réflexions stratégiques')
@section('page_subtitle', 'Salle d’analyse, de vision et d’orientation technique du hub.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Fenêtre stratégie</h4>
                        <p class="text-muted mb-0">Zone de pensée technique, d’orientation et de cadrage des choix majeurs.
                        </p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.chambre-ingenieur.reflexions.toutes') }}"
                            class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
                        <a href="{{ route('back.chambre-ingenieur.reflexions.ouvertes') }}"
                            class="btn btn-outline-primary rounded-pill px-4">Ouvertes</a>
                        <a href="{{ route('back.chambre-ingenieur.reflexions.validees') }}"
                            class="btn btn-outline-success rounded-pill px-4">Validées</a>
                        <a href="{{ route('back.chambre-ingenieur.reflexions.archivees') }}"
                            class="btn btn-outline-secondary rounded-pill px-4">Archivées</a>
                        <a href="{{ route('back.chambre-ingenieur.reflexions.creer') }}"
                            class="btn btn-primary rounded-pill px-4">Nouvelle réflexion</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="row g-4">
                    @forelse($reflexions as $reflexion)
                        <div class="col-md-6 col-xl-4">
                            <div class="hub-card">
                                <div class="hub-card-top">
                                    <span
                                        class="badge rounded-pill text-bg-light border">{{ ucfirst($reflexion->statut) }}</span>
                                </div>
                                <h5 class="fw-bold mt-3">{{ $reflexion->titre }}</h5>
                                <p class="text-muted small mb-3">
                                    {{ \Illuminate\Support\Str::limit($reflexion->contexte, 120) }}</p>
                                <div class="small text-muted mb-3">Auteur : {{ $reflexion->auteur->name ?? '—' }}</div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('back.chambre-ingenieur.reflexions.details', $reflexion) }}"
                                        class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                    <a href="{{ route('back.chambre-ingenieur.reflexions.modifier', $reflexion) }}"
                                        class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSuppressionReflexion{{ $reflexion->id }}">
                                        Supprimer
                                    </button>
                                </div>

                                @include('back.chambre-ingenieur.reflexions._modales', [
                                    'reflexion' => $reflexion,
                                ])
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">Aucune réflexion stratégique trouvée.</div>
                    @endforelse
                </div>

                <div class="mt-4">{{ $reflexions->links() }}</div>
            </div>
        </div>
    </div>

    <style>
        .hub-card {
            padding: 22px;
            border-radius: 22px;
            border: 1px solid #e5e7eb;
            background: #fff;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .04);
            height: 100%
        }
    </style>
@endsection
