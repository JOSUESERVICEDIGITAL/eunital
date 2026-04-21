@extends('back.layouts.principal')

@section('title', 'Calendrier des congés')
@section('page_title', 'Calendrier des congés')
@section('page_subtitle', 'Vision mensuelle des absences planifiées pour améliorer la coordination et l’anticipation RH.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Calendrier du mois</h4>
                        <p class="text-muted mb-0">{{ $moisCourant->translatedFormat('F Y') }}</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rh.conges.calendrier', ['mois' => $moisPrecedent]) }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa-solid fa-chevron-left me-2"></i>Précédent
                        </a>
                        <a href="{{ route('rh.conges.calendrier', ['mois' => $moisSuivant]) }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Suivant<i class="fa-solid fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                @if($conges->count())
                    <div class="calendar-list">
                        @foreach($conges as $conge)
                            <div class="calendar-item">
                                <div class="calendar-item-icon bg-warning-subtle text-warning">
                                    <i class="fa-solid fa-calendar-day"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">
                                        {{ optional($conge->membreEquipe)->nom }} {{ optional($conge->membreEquipe)->prenom }}
                                    </div>
                                    <div class="text-muted small">
                                        {{ ucfirst(str_replace('_', ' ', $conge->type_conge)) }}
                                        • {{ $conge->date_debut?->format('d/m/Y') }} → {{ $conge->date_fin?->format('d/m/Y') }}
                                    </div>
                                </div>
                                <a href="{{ route('rh.conges.show', $conge) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                    Ouvrir
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa-solid fa-calendar-days empty-state-icon"></i>
                        <h5 class="mt-3">Aucun congé sur cette période</h5>
                        <p class="text-muted">Le calendrier est vide pour le mois sélectionné.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <style>
        .calendar-list{display:flex;flex-direction:column;gap:12px}
        .calendar-item{display:flex;align-items:center;gap:16px;padding:14px;border:1px solid #eef2f7;border-radius:18px}
        .calendar-item-icon{width:50px;height:50px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:18px}
        .empty-state{text-align:center;padding:30px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection