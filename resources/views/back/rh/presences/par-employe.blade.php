@extends('back.layouts.principal')

@section('title', 'Présences par employé')
@section('page_title', 'Présences par employé')
@section('page_subtitle', 'Historique individuel des présences avec lecture RH rapide des statuts et habitudes.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $membre->nom }} {{ $membre->prenom }}</h4>
                        <p class="text-muted mb-0">
                            {{ optional($membre->departement)->nom ?? 'Département non défini' }}
                            • {{ optional($membre->poste)->nom ?? 'Poste non défini' }}
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.presences.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
                        <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-outline-primary rounded-pill px-4">Dossiers RH</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Total</div>
                        <h3 class="stat-number">{{ $stats['total'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Présents</div>
                        <h3 class="stat-number">{{ $stats['present'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Absents</div>
                        <h3 class="stat-number">{{ $stats['absent'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Retards</div>
                        <h3 class="stat-number">{{ $stats['retard'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.presences._table-list', [
                'pageTitleInner' => 'Historique des présences',
                'description' => 'Tous les pointages de cet employé.',
                'presencesList' => $presences
            ])
        </div>

    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:30px;font-weight:800;margin:0}
    </style>
@endsection