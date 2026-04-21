@extends('back.layouts.principal')

@section('title', 'Statistiques bien-être')
@section('page_title', 'Statistiques bien-être')
@section('page_subtitle', 'Vue analytique des dossiers bien-être, des priorités et de la répartition organisationnelle.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.bien-etre.statistiques') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Date début</label>
                            <input type="date" name="date_debut" value="{{ $dateDebut->format('Y-m-d') }}" class="form-control custom-input">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Date fin</label>
                            <input type="date" name="date_fin" value="{{ $dateFin->format('Y-m-d') }}" class="form-control custom-input">
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Actualiser</button>
                                <a href="{{ route('rh.bien-etre.statistiques') }}" class="btn btn-outline-secondary rounded-pill px-4">Réinitialiser</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Total</div>
                <h3 class="stat-number">{{ $stats['total'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Ouverts</div>
                <h3 class="stat-number">{{ $stats['ouverts'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Urgents</div>
                <h3 class="stat-number text-danger">{{ $stats['priorite_urgente'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="content-card h-100">
                <div class="mini-label">Traités</div>
                <h3 class="stat-number text-success">{{ $stats['traites'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Répartition par type</h5>
                <div class="ranking-list">
                    @forelse($statsParType as $type => $total)
                        <div class="ranking-item">
                            <span class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $type)) }}</span>
                            <span class="badge rounded-pill text-bg-light border">{{ $total }}</span>
                        </div>
                    @empty
                        <div class="text-muted">Aucune donnée disponible.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Répartition par priorité</h5>
                <div class="ranking-list">
                    @forelse($statsParPriorite as $niveau => $total)
                        <div class="ranking-item">
                            <span class="fw-semibold">{{ ucfirst($niveau) }}</span>
                            <span class="badge rounded-pill text-bg-light border">{{ $total }}</span>
                        </div>
                    @empty
                        <div class="text-muted">Aucune donnée disponible.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Par département</h5>
                <div class="ranking-list">
                    @forelse($statsParDepartement as $row)
                        <div class="ranking-item">
                            <span class="fw-semibold">{{ $row->departement }}</span>
                            <span class="badge rounded-pill text-bg-light border">{{ $row->total }}</span>
                        </div>
                    @empty
                        <div class="text-muted">Aucune donnée disponible.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <style>
        .custom-input{height:48px;border-radius:16px}
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:30px;font-weight:800;margin:0}
        .ranking-list{display:flex;flex-direction:column;gap:12px}
        .ranking-item{display:flex;justify-content:space-between;align-items:center;gap:16px;padding:14px;border:1px solid #eef2f7;border-radius:16px}
    </style>
@endsection