@extends('back.layouts.principal')

@section('title', 'Présences journalières')
@section('page_title', 'Présences journalières')
@section('page_subtitle', 'Vue opérationnelle du jour : présents, absents, retards, missions et télétravail.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $dateReference->format('d/m/Y') }}</h4>
                        <p class="text-muted mb-0">Suivi journalier des présences.</p>
                    </div>

                    <form method="GET" action="{{ route('rh.presences.journalier') }}" class="d-flex flex-wrap gap-2 align-items-center">
                        <input type="date" name="date" value="{{ $dateReference->format('Y-m-d') }}" class="form-control custom-input-small">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Changer de date</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row g-4">
                @foreach([
                    ['label' => 'Total', 'value' => $stats['total'] ?? 0, 'class' => 'primary', 'icon' => 'fa-list'],
                    ['label' => 'Présents', 'value' => $stats['present'] ?? 0, 'class' => 'success', 'icon' => 'fa-circle-check'],
                    ['label' => 'Absents', 'value' => $stats['absent'] ?? 0, 'class' => 'danger', 'icon' => 'fa-user-xmark'],
                    ['label' => 'Retards', 'value' => $stats['retard'] ?? 0, 'class' => 'warning', 'icon' => 'fa-hourglass-half'],
                    ['label' => 'Télétravail', 'value' => $stats['teletravail'] ?? 0, 'class' => 'info', 'icon' => 'fa-laptop-house'],
                    ['label' => 'Congé', 'value' => $stats['conge'] ?? 0, 'class' => 'secondary', 'icon' => 'fa-calendar-days'],
                ] as $card)
                    <div class="col-md-4 col-xl-2">
                        <div class="content-card h-100">
                            <div class="mini-label">{{ $card['label'] }}</div>
                            <h3 class="stat-number">{{ $card['value'] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.presences._table-list', [
                'pageTitleInner' => 'Présences du jour',
                'description' => 'Tous les enregistrements du jour sélectionné.',
                'presencesList' => $presences
            ])
        </div>

    </div>

    <style>
        .custom-input-small{height:46px;border-radius:16px;min-width:170px}
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:30px;font-weight:800;margin:0}
    </style>
@endsection