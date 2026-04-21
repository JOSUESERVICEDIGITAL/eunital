@extends('back.layouts.principal')

@section('title', 'Congés par employé')
@section('page_title', 'Congés par employé')
@section('page_subtitle', 'Historique complet des congés d’un collaborateur avec lien direct vers son dossier RH.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $membre->nom }} {{ $membre->prenom }}</h4>
                        <p class="text-muted mb-0">
                            {{ optional($membre->departement)->nom ?? 'Département non défini' }}
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-folder-open me-2"></i>Dossiers RH
                        </a>
                        <a href="{{ route('rh.conges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.conges._table-status', [
                'pageTitleInner' => 'Historique des congés',
                'description' => 'Toutes les demandes liées à cet employé.',
                'congesList' => $conges,
                'showValidationActions' => false
            ])
        </div>

    </div>
@endsection