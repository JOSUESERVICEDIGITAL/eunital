@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="mb-1">Dashboard Graphisme</h3>
        <p class="text-muted mb-0">
            Vue globale des activités de design, branding, UI/UX et demandes clients.
        </p>
    </div>

    {{-- KPIs --}}
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Créations graphiques</small>
                    <h3 class="fw-bold">{{ $stats['creations'] ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Identités visuelles</small>
                    <h3 class="fw-bold">{{ $stats['identites'] ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Affiches & flyers</small>
                    <h3 class="fw-bold">{{ $stats['affiches'] ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Visuels réseaux</small>
                    <h3 class="fw-bold">{{ $stats['reseaux'] ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">UI / UX</small>
                    <h3 class="fw-bold">{{ $stats['uiux'] ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Maquettes</small>
                    <h3 class="fw-bold">{{ $stats['maquettes'] ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Demandes clients</small>
                    <h3 class="fw-bold">{{ $stats['demandes'] ?? 0 }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- DERNIERES CREATIONS + DEMANDES --}}
    <div class="row g-4">

        {{-- DERNIERES CREATIONS --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">🎨 Dernières créations</h5>

                        <a href="{{ route('back.chambre-graphisme.creations.toutes') }}"
                           class="btn btn-sm btn-outline-dark rounded-pill">
                            Voir tout
                        </a>
                    </div>

                    @forelse($dernieresCreations as $creation)
                        <div class="border rounded-3 p-3 mb-2">

                            <div class="fw-semibold">
                                {{ $creation->titre }}
                            </div>

                            <div class="small text-muted">
                                {{ $creation->client->nom ?? '—' }}
                            </div>

                            <div class="mt-1">
                                @php
                                    $badge = match($creation->statut) {
                                        'brouillon' => 'secondary',
                                        'en_cours' => 'warning',
                                        'validation' => 'info',
                                        'livre' => 'success',
                                        default => 'dark'
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $badge }}">
                                    {{ ucfirst(str_replace('_',' ', $creation->statut)) }}
                                </span>
                            </div>

                        </div>
                    @empty
                        <p class="text-muted">Aucune création récente.</p>
                    @endforelse

                </div>
            </div>
        </div>

        {{-- DERNIERES DEMANDES --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">📩 Demandes clients</h5>

                        <a href="{{ route('back.chambre-graphisme.clients-demandes.toutes') }}"
                           class="btn btn-sm btn-outline-dark rounded-pill">
                            Voir tout
                        </a>
                    </div>

                    @forelse($dernieresDemandes as $demande)
                        <div class="border rounded-3 p-3 mb-2">

                            <div class="fw-semibold">
                                {{ $demande->titre }}
                            </div>

                            <div class="small text-muted">
                                {{ $demande->client->nom ?? '—' }}
                            </div>

                            <div class="mt-1">
                                @php
                                    $badge = match($demande->statut) {
                                        'en_attente' => 'secondary',
                                        'en_cours' => 'warning',
                                        'termine' => 'success',
                                        default => 'dark'
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $badge }}">
                                    {{ ucfirst(str_replace('_',' ', $demande->statut)) }}
                                </span>
                            </div>

                        </div>
                    @empty
                        <p class="text-muted">Aucune demande récente.</p>
                    @endforelse

                </div>
            </div>
        </div>

    </div>

</div>
@endsection