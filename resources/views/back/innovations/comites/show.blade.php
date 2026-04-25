@extends('back.layouts.principal')

@section('title', 'Fiche comité')
@section('page_title', $comite->nom)
@section('page_subtitle', 'Instance de gouvernance et décision innovation.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="comite-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">{{ $comite->type_comite }}</span>
                <h2>{{ $comite->nom }}</h2>
                <p>{{ $comite->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.comites.edit', $comite) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.comites.sessions', $comite) }}" class="btn btn-light rounded-pill px-4">Sessions</a>
                <a href="{{ route('back.innovations.comites.decisions', $comite) }}" class="btn btn-outline-light rounded-pill px-4">Décisions</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Sessions</span><strong>{{ $comite->sessions->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Statut</span><strong>{{ $comite->statut }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Type</span><strong>{{ $comite->type_comite }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Décisions</span><strong>{{ $comite->sessions->sum(fn($s) => $s->decisions->count()) }}</strong></div></div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Modules rapides</h5>

            <div class="d-grid gap-2">
                <a href="{{ route('back.innovations.comites.sessions', $comite) }}" class="btn btn-light rounded-pill text-start px-4">
                    <i class="fa-solid fa-calendar-days me-2"></i>Sessions
                </a>
                <a href="{{ route('back.innovations.comites.planning', $comite) }}" class="btn btn-light rounded-pill text-start px-4">
                    <i class="fa-solid fa-clock me-2"></i>Planning
                </a>
                <a href="{{ route('back.innovations.comites.decisions', $comite) }}" class="btn btn-light rounded-pill text-start px-4">
                    <i class="fa-solid fa-scale-balanced me-2"></i>Décisions
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Dernières sessions</h5>

            <div class="hub-list">
                @forelse($comite->sessions->take(5) as $session)
                    <div class="hub-list-item">
                        <div class="hub-list-icon">
                            <i class="fa-solid fa-users-gear"></i>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $session->titre }}</div>
                            <small>{{ optional($session->date_session)->format('d/m/Y H:i') ?? 'Date non définie' }}</small>
                            <p class="text-muted mt-2 mb-0">{{ Str::limit($session->ordre_du_jour, 120) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-5">Aucune session.</div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@include('back.innovations.comites._styles')
@endsection
