@extends('back.layouts.principal')

@section('title', 'Présences hebdomadaires')
@section('page_title', 'Présences hebdomadaires')
@section('page_subtitle', 'Vue semaine des présences pour suivre les dynamiques d’équipe et les anomalies de présence.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">
                            Semaine du {{ $debutSemaine->format('d/m/Y') }} au {{ $finSemaine->format('d/m/Y') }}
                        </h4>
                        <p class="text-muted mb-0">Analyse hebdomadaire des présences.</p>
                    </div>

                    <form method="GET" action="{{ route('rh.presences.hebdomadaire') }}" class="d-flex flex-wrap gap-2 align-items-center">
                        <input type="date" name="date" value="{{ $dateReference->format('Y-m-d') }}" class="form-control custom-input-small">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Changer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.presences._stats-status-grid', ['statsParStatut' => $statsParStatut])
        </div>

        <div class="col-12">
            @include('back.rh.presences._table-list', [
                'pageTitleInner' => 'Présences de la semaine',
                'description' => 'Tous les enregistrements sur la semaine sélectionnée.',
                'presencesList' => $presences
            ])
        </div>
    </div>

    <style>
        .custom-input-small{height:46px;border-radius:16px;min-width:170px}
    </style>
@endsection