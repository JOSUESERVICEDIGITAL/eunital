@extends('back.layouts.principal')

@section('title', 'Présences mensuelles')
@section('page_title', 'Présences mensuelles')
@section('page_subtitle', 'Vue mensuelle des présences pour le pilotage RH, le suivi des habitudes et l’analyse de charge.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $dateReference->translatedFormat('F Y') }}</h4>
                        <p class="text-muted mb-0">Analyse mensuelle des présences.</p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rh.presences.mensuel', ['mois' => $moisPrecedent]) }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-chevron-left me-2"></i>Précédent
                        </a>
                        <a href="{{ route('rh.presences.mensuel', ['mois' => $moisSuivant]) }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Suivant<i class="fa-solid fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.presences._stats-status-grid', ['statsParStatut' => $statsParStatut])
        </div>

        <div class="col-12">
            @include('back.rh.presences._table-list', [
                'pageTitleInner' => 'Présences du mois',
                'description' => 'Tous les enregistrements du mois sélectionné.',
                'presencesList' => $presences
            ])
        </div>

    </div>
@endsection