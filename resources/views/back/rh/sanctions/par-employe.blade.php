@extends('back.layouts.principal')

@section('title', 'Sanctions par employé')
@section('page_title', 'Sanctions par employé')
@section('page_subtitle', 'Historique disciplinaire individuel avec lecture rapide des états et volumes par collaborateur.')

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
                        <a href="{{ route('rh.sanctions.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
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
                        <div class="mini-label">Actives</div>
                        <h3 class="stat-number">{{ $stats['actives'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Levées</div>
                        <h3 class="stat-number">{{ $stats['levees'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Archivées</div>
                        <h3 class="stat-number">{{ $stats['archivees'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.sanctions._table-status', [
                'pageTitleInner' => 'Historique disciplinaire',
                'description' => 'Toutes les sanctions de cet employé.',
                'sanctionsList' => $sanctions
            ])
        </div>

    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:30px;font-weight:800;margin:0}
    </style>
@endsection