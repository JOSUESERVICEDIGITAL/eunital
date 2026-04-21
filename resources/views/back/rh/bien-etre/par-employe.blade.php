@extends('back.layouts.principal')

@section('title', 'Bien-être par employé')
@section('page_title', 'Bien-être par employé')
@section('page_subtitle', 'Suivi individuel des dossiers bien-être et des accompagnements RH d’un collaborateur.')

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
                        <a href="{{ route('rh.bien-etre.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
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
                        <div class="mini-label">Ouverts</div>
                        <h3 class="stat-number">{{ $stats['ouverts'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">En cours</div>
                        <h3 class="stat-number">{{ $stats['en_cours'] ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Traités</div>
                        <h3 class="stat-number">{{ $stats['traites'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.bien-etre._table-status', [
                'pageTitleInner' => 'Historique bien-être',
                'description' => 'Tous les dossiers de cet employé.',
                'dossiersList' => $dossiers
            ])
        </div>

    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:30px;font-weight:800;margin:0}
    </style>
@endsection