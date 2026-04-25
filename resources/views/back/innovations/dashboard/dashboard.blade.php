@extends('back.layouts.principal')

@section('title', 'Dashboard Innovation')
@section('page_title', 'Chambre rénovation & innovation')
@section('page_subtitle', 'Pilotage national des innovations, rénovations, réformes et déploiements.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="innovation-hero">
            <div>
                <span class="hero-badge">Hyper chambre nationale</span>
                <h2>Rénovation & Innovation</h2>
                <p>
                    Suivi stratégique des propositions, idées, innovations, réformes,
                    expérimentations, déploiements et impacts.
                </p>
            </div>

            <div class="hero-actions">
                <a href="{{ route('back.innovations.innovations.create') }}" class="btn btn-warning rounded-pill px-4">
                    <i class="fa-solid fa-lightbulb me-2"></i>Nouvelle innovation
                </a>
                <a href="{{ route('back.innovations.propositions.create') }}" class="btn btn-outline-light rounded-pill px-4">
                    <i class="fa-solid fa-plus me-2"></i>Nouvelle proposition
                </a>
            </div>
        </div>
    </div>

    @php
        $cards = [
            ['label' => 'Portefeuilles', 'value' => $stats['portefeuilles'] ?? 0, 'icon' => 'fa-layer-group', 'class' => 'primary'],
            ['label' => 'Innovations', 'value' => $stats['innovations'] ?? 0, 'icon' => 'fa-lightbulb', 'class' => 'warning'],
            ['label' => 'Propositions', 'value' => $stats['propositions'] ?? 0, 'icon' => 'fa-inbox', 'class' => 'info'],
            ['label' => 'Idées', 'value' => $stats['idees'] ?? 0, 'icon' => 'fa-brain', 'class' => 'success'],
            ['label' => 'Réformes', 'value' => $stats['reformes'] ?? 0, 'icon' => 'fa-rotate', 'class' => 'secondary'],
            ['label' => 'Expérimentations', 'value' => $stats['experimentations'] ?? 0, 'icon' => 'fa-flask', 'class' => 'purple'],
            ['label' => 'Déploiements', 'value' => $stats['deploiements'] ?? 0, 'icon' => 'fa-map-location-dot', 'class' => 'danger'],
            ['label' => 'Financements obtenus', 'value' => number_format($stats['financements'] ?? 0, 0, ',', ' ') . ' €', 'icon' => 'fa-coins', 'class' => 'gold'],
        ];
    @endphp

    @foreach($cards as $card)
        <div class="col-xl-3 col-md-6">
            <div class="innovation-stat-card">
                <div>
                    <div class="stat-label">{{ $card['label'] }}</div>
                    <div class="stat-value">{{ $card['value'] }}</div>
                </div>
                <div class="stat-icon {{ $card['class'] }}">
                    <i class="fa-solid {{ $card['icon'] }}"></i>
                </div>
            </div>
        </div>
    @endforeach

    <div class="col-xl-8">
        <div class="content-card h-100">
            <div class="section-head">
                <div>
                    <h4>Innovations récentes</h4>
                    <p>Dernières initiatives créées dans la chambre.</p>
                </div>
                <a href="{{ route('back.innovations.innovations.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                    Tout voir
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle hub-table">
                    <thead>
                        <tr>
                            <th>Innovation</th>
                            <th>Portefeuille</th>
                            <th>Responsable</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($innovationsRecentes as $innovation)
                            <tr>
                                <td>
                                    <a href="{{ route('back.innovations.innovations.show', $innovation) }}" class="fw-bold text-decoration-none">
                                        {{ $innovation->titre }}
                                    </a>
                                    <div class="text-muted small">{{ $innovation->code }}</div>
                                </td>
                                <td>{{ optional($innovation->portefeuille)->nom ?? '—' }}</td>
                                <td>{{ optional($innovation->responsable)->name ?? '—' }}</td>
                                <td><span class="badge rounded-pill text-bg-light border">{{ $innovation->statut }}</span></td>
                                <td><span class="badge rounded-pill bg-warning-subtle text-warning">{{ $innovation->niveau_priorite }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Aucune innovation récente.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <div class="section-head">
                <div>
                    <h4>Propositions critiques</h4>
                    <p>Points urgents à analyser.</p>
                </div>
            </div>

            <div class="hub-list">
                @forelse($propositionsUrgentes as $proposition)
                    <a href="{{ route('back.innovations.propositions.show', $proposition) }}" class="hub-list-item">
                        <div class="hub-list-icon danger">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $proposition->titre }}</div>
                            <small>{{ $proposition->origine }} • {{ $proposition->statut }}</small>
                        </div>
                    </a>
                @empty
                    <div class="empty-mini">Aucune proposition critique.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <div class="section-head">
                <div>
                    <h4>Déploiements en cours</h4>
                    <p>Suivi des innovations en phase terrain.</p>
                </div>
                <a href="{{ route('back.innovations.deploiements.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                    Voir les déploiements
                </a>
            </div>

            <div class="row g-3">
                @forelse($deploiementsEnCours as $deploiement)
                    <div class="col-md-4">
                        <div class="deployment-card">
                            <div class="d-flex justify-content-between gap-3">
                                <div>
                                    <h6>{{ $deploiement->titre }}</h6>
                                    <p>{{ optional($deploiement->innovation)->titre ?? 'Innovation non liée' }}</p>
                                </div>
                                <span class="badge rounded-pill text-bg-info">En cours</span>
                            </div>
                            <div class="small text-muted">
                                Début : {{ optional($deploiement->date_debut)->format('d/m/Y') ?? '—' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-4">Aucun déploiement en cours.</div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@include('back.innovations.dashboard._styles')
@endsection
