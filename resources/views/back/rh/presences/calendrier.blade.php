@extends('back.layouts.principal')

@section('title', 'Calendrier des présences')
@section('page_title', 'Calendrier des présences')
@section('page_subtitle', 'Vue calendrier des pointages pour repérer rapidement les jours actifs, les anomalies et les volumes de présence.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $moisCourant->translatedFormat('F Y') }}</h4>
                        <p class="text-muted mb-0">Répartition des présences par jour.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rh.presences.calendrier', ['mois' => $moisPrecedent]) }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-chevron-left me-2"></i>Précédent
                        </a>
                        <a href="{{ route('rh.presences.calendrier', ['mois' => $moisSuivant]) }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Suivant<i class="fa-solid fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                @if($presencesParJour->count())
                    <div class="calendar-day-list">
                        @foreach($presencesParJour as $jour => $items)
                            <div class="calendar-day-card">
                                <div class="calendar-day-head">
                                    <div>
                                        <h5 class="fw-bold mb-1">{{ \Carbon\Carbon::parse($jour)->format('d/m/Y') }}</h5>
                                        <p class="text-muted mb-0">{{ $items->count() }} enregistrement(s)</p>
                                    </div>
                                    <a href="{{ route('rh.presences.journalier', ['date' => $jour]) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                        Ouvrir
                                    </a>
                                </div>

                                <div class="calendar-mini-list">
                                    @foreach($items->take(6) as $presence)
                                        <div class="calendar-mini-item">
                                            <span class="fw-semibold">{{ optional($presence->membreEquipe)->nom }} {{ optional($presence->membreEquipe)->prenom }}</span>
                                            <span class="badge rounded-pill text-bg-light border">
                                                {{ ucfirst(str_replace('_', ' ', $presence->statut)) }}
                                            </span>
                                        </div>
                                    @endforeach

                                    @if($items->count() > 6)
                                        <div class="text-muted small mt-2">
                                            + {{ $items->count() - 6 }} autre(s)
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa-solid fa-calendar empty-state-icon"></i>
                        <h5 class="mt-3">Aucune présence sur cette période</h5>
                        <p class="text-muted">Le calendrier est vide pour le mois sélectionné.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <style>
        .calendar-day-list{display:flex;flex-direction:column;gap:16px}
        .calendar-day-card{border:1px solid #eef2f7;border-radius:20px;padding:18px}
        .calendar-day-head{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:12px}
        .calendar-mini-list{display:flex;flex-direction:column;gap:10px}
        .calendar-mini-item{display:flex;justify-content:space-between;align-items:center;gap:16px;padding:10px 12px;background:#f8fafc;border-radius:14px}
        .empty-state{text-align:center;padding:30px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection