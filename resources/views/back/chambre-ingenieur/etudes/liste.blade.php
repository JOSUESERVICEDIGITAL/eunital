@extends('back.layouts.principal')

@section('title', 'Études de faisabilité')
@section('page_title', 'Chambre d’ingénieurs · Études de faisabilité')
@section('page_subtitle', 'Salle d’évaluation, de risques et de décision sur la faisabilité des projets.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Fenêtre faisabilité</h4>
                        <p class="text-muted mb-0">Évaluation technique, humaine, financière et décisionnelle.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.chambre-ingenieur.etudes.toutes') }}"
                            class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
                        <a href="{{ route('back.chambre-ingenieur.etudes.favorables') }}"
                            class="btn btn-outline-success rounded-pill px-4">Favorables</a>
                        <a href="{{ route('back.chambre-ingenieur.etudes.reservees') }}"
                            class="btn btn-outline-warning rounded-pill px-4">Réservées</a>
                        <a href="{{ route('back.chambre-ingenieur.etudes.defavorables') }}"
                            class="btn btn-outline-danger rounded-pill px-4">Défavorables</a>
                        <a href="{{ route('back.chambre-ingenieur.etudes.creer') }}"
                            class="btn btn-primary rounded-pill px-4">Nouvelle étude</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="row g-4">
                    @forelse($etudes as $etude)
                        <div class="col-lg-6">
                            <div class="hub-card">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-bold mb-0">{{ $etude->titre }}</h5>
                                    <span
                                        class="badge rounded-pill text-bg-light border">{{ ucfirst($etude->decision) }}</span>
                                </div>
                                <p class="text-muted small">{{ \Illuminate\Support\Str::limit($etude->description, 160) }}
                                </p>
                                <div class="small text-muted mb-3">Auteur : {{ $etude->auteur->name ?? '—' }}</div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('back.chambre-ingenieur.etudes.details', $etude) }}"
                                        class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                    <a href="{{ route('back.chambre-ingenieur.etudes.modifier', $etude) }}"
                                        class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                        data-bs-toggle="modal" data-bs-target="#modalSuppressionEtude{{ $etude->id }}">
                                        Supprimer
                                    </button>
                                </div>

                                @include('back.chambre-ingenieur.etudes._modales', ['etude' => $etude])
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">Aucune étude trouvée.</div>
                    @endforelse
                </div>

                <div class="mt-4">{{ $etudes->links() }}</div>
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
