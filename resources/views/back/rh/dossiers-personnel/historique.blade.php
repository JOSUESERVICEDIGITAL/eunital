@extends('back.layouts.principal')

@section('title', 'Historique du dossier du personnel')
@section('page_title', 'Historique du dossier')
@section('page_subtitle', 'Vision consolidée du parcours RH du collaborateur : présence, congés, évaluations, discipline et suivi humain.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">
                            {{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}
                        </h4>
                        <p class="text-muted mb-0">Historique consolidé du collaborateur.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.dossiers-personnel.show', $dossier) }}" class="btn btn-outline-primary rounded-pill px-4">Fiche</a>
                        <a href="{{ route('rh.dossiers-personnel.timeline', $dossier) }}" class="btn btn-outline-secondary rounded-pill px-4">Timeline</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Présences récentes</h5>
                <div class="list-feed">
                    @forelse($dossier->presences as $presence)
                        <div class="list-item">
                            <div>
                                <div class="fw-bold">{{ $presence->date_presence?->format('d/m/Y') }}</div>
                                <div class="text-muted small">Statut : {{ ucfirst($presence->statut) }}</div>
                            </div>
                            <span class="badge text-bg-light border">{{ $presence->heure_arrivee ?? '—' }}</span>
                        </div>
                    @empty
                        <div class="text-muted">Aucune présence enregistrée.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Congés récents</h5>
                <div class="list-feed">
                    @forelse($dossier->conges as $conge)
                        <div class="list-item">
                            <div>
                                <div class="fw-bold">{{ ucfirst(str_replace('_', ' ', $conge->type_conge)) }}</div>
                                <div class="text-muted small">
                                    {{ $conge->date_debut?->format('d/m/Y') }} → {{ $conge->date_fin?->format('d/m/Y') }}
                                </div>
                            </div>
                            <span class="badge rounded-pill text-bg-warning">{{ ucfirst(str_replace('_', ' ', $conge->statut)) }}</span>
                        </div>
                    @empty
                        <div class="text-muted">Aucun congé enregistré.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Évaluations</h5>
                <div class="list-feed">
                    @forelse($dossier->evaluations as $evaluation)
                        <div class="list-item">
                            <div>
                                <div class="fw-bold">{{ $evaluation->titre }}</div>
                                <div class="text-muted small">{{ $evaluation->date_evaluation?->format('d/m/Y') ?? 'Date non définie' }}</div>
                            </div>
                            <span class="badge rounded-pill text-bg-info">{{ $evaluation->note_globale ?? '—' }}/10</span>
                        </div>
                    @empty
                        <div class="text-muted">Aucune évaluation enregistrée.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Discipline & bien-être</h5>
                <div class="list-feed">
                    @forelse($dossier->sanctions as $sanction)
                        <div class="list-item">
                            <div>
                                <div class="fw-bold">{{ $sanction->motif }}</div>
                                <div class="text-muted small">{{ $sanction->date_sanction?->format('d/m/Y') ?? '—' }}</div>
                            </div>
                            <span class="badge rounded-pill text-bg-danger">{{ ucfirst($sanction->statut) }}</span>
                        </div>
                    @empty
                        <div class="text-muted mb-3">Aucune sanction enregistrée.</div>
                    @endforelse

                    @foreach($dossier->signalementsBienEtre as $signalement)
                        <div class="list-item">
                            <div>
                                <div class="fw-bold">{{ $signalement->titre }}</div>
                                <div class="text-muted small">{{ ucfirst($signalement->type) }}</div>
                            </div>
                            <span class="badge rounded-pill text-bg-secondary">{{ ucfirst(str_replace('_', ' ', $signalement->statut)) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <style>
        .list-feed{display:flex;flex-direction:column;gap:12px}
        .list-item{display:flex;justify-content:space-between;align-items:center;gap:16px;padding:14px;border:1px solid #eef2f7;border-radius:18px}
    </style>
@endsection
