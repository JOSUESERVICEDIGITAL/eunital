@extends('back.formation.layouts.app')

@section('title', 'Détails inscription')
@section('page_title', 'Détails de l’inscription')
@section('page_subtitle', 'Suivi complet de l’étudiant dans le module')

@section('formation-content')
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 font-weight-bold">{{ $inscription->user->name }}</h4>
                    <div class="text-muted small">
                        Module :
                        <a href="{{ route('back.formation.modules.show', $inscription->module) }}" class="font-weight-bold text-info">
                            {{ $inscription->module->titre }}
                        </a>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0">
                    <a href="{{ route('back.formation.inscriptions.edit', $inscription) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit mr-1"></i> Modifier
                    </a>
                    <a href="{{ route('back.formation.presences.index') }}?inscription_id={{ $inscription->id }}" class="btn btn-success btn-sm">
                        <i class="fas fa-user-check mr-1"></i> Présences
                    </a>
                    <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#quickToolsModal">
                        <i class="fas fa-bolt mr-1"></i> Outils
                    </button>
                    <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <div class="avatar-circle mx-auto mb-3" style="width: 84px; height: 84px; font-size: 34px;">
                    {{ strtoupper(substr($inscription->user->name, 0, 1)) }}
                </div>

                <h4 class="mb-1">{{ $inscription->user->name }}</h4>
                <p class="text-muted mb-3">{{ $inscription->user->email }}</p>

                <span class="badge badge-{{ $inscription->statut === 'valide' ? 'success' : ($inscription->statut === 'en_attente' ? 'warning' : ($inscription->statut === 'termine' ? 'info' : 'danger')) }}">
                    {{ ucfirst(str_replace('_', ' ', $inscription->statut)) }}
                </span>

                <hr>

                <dl class="text-left mb-0">
                    <dt>Inscrit le</dt>
                    <dd>{{ $inscription->created_at->format('d/m/Y H:i') }}</dd>

                    <dt>Début</dt>
                    <dd>{{ $inscription->date_debut ? \Carbon\Carbon::parse($inscription->date_debut)->format('d/m/Y') : '—' }}</dd>

                    <dt>Fin</dt>
                    <dd>{{ $inscription->date_fin ? \Carbon\Carbon::parse($inscription->date_fin)->format('d/m/Y') : '—' }}</dd>

                    <dt>Dernière activité</dt>
                    <dd>{{ $inscription->derniere_activite ? \Carbon\Carbon::parse($inscription->derniere_activite)->format('d/m/Y H:i') : 'Aucune activité' }}</dd>
                </dl>
            </div>
        </div>

        <div class="card mt-3 shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-chart-line mr-2"></i> Performance
                </h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Progression globale</span>
                        <strong>{{ $inscription->progression }}%</strong>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: {{ $inscription->progression }}%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Taux de présence</span>
                        <strong>{{ round($inscription->taux_presence, 1) }}%</strong>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success" style="width: {{ $inscription->taux_presence }}%"></div>
                    </div>
                </div>

                <dl class="row mb-0">
                    <dt class="col-sm-8">Note moyenne</dt>
                    <dd class="col-sm-4"><span class="badge badge-info">{{ round($noteMoyenne ?? 0, 1) }}/20</span></dd>

                    <dt class="col-sm-8">Devoirs rendus</dt>
                    <dd class="col-sm-4"><span class="badge badge-success">{{ $devoirsRendus ?? 0 }}/{{ $totalDevoirs ?? 0 }}</span></dd>

                    <dt class="col-sm-8">Quiz réussis</dt>
                    <dd class="col-sm-4"><span class="badge badge-warning">{{ $quizReussis ?? 0 }}/{{ $totalQuiz ?? 0 }}</span></dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-compass mr-2"></i> Navigation liée à l’inscription
                </h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.modules.show', $inscription->module) }}" class="btn btn-outline-info btn-block">
                            <i class="fas fa-layer-group d-block mb-2"></i> Module
                        </a>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.presences.index') }}?inscription_id={{ $inscription->id }}" class="btn btn-outline-success btn-block">
                            <i class="fas fa-user-check d-block mb-2"></i> Présences
                        </a>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.soumissions.index') }}?user_id={{ $inscription->user_id }}" class="btn btn-outline-warning btn-block">
                            <i class="fas fa-tasks d-block mb-2"></i> Soumissions
                        </a>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <button type="button" class="btn btn-outline-dark btn-block" data-toggle="modal" data-target="#quickToolsModal">
                            <i class="fas fa-bolt d-block mb-2"></i> Outils
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Garde tes blocs cours / présences / devoirs / activité si tu veux, ils sont déjà riches --}}
        {{-- Tu peux garder la grande partie de ton code actuel ici presque telle quelle --}}
    </div>
</div>

<div class="modal fade" id="quickToolsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="fas fa-bolt mr-2"></i> Outils rapides</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center">
                <a href="{{ route('back.formation.inscriptions.edit', $inscription) }}" class="btn btn-warning m-1">
                    <i class="fas fa-edit mr-1"></i> Modifier
                </a>

                @if($inscription->statut === 'en_attente')
                    <button type="button" class="btn btn-success m-1" onclick="validerInscription({{ $inscription->id }})">
                        <i class="fas fa-check-circle mr-1"></i> Valider
                    </button>
                @endif

                @if($inscription->statut === 'valide')
                    <button type="button" class="btn btn-info m-1" onclick="terminerInscription({{ $inscription->id }})">
                        <i class="fas fa-flag-checkered mr-1"></i> Terminer
                    </button>
                @endif

                @if(in_array($inscription->statut, ['en_attente', 'valide']))
                    <button type="button" class="btn btn-danger m-1" onclick="abandonnerInscription({{ $inscription->id }})">
                        <i class="fas fa-times-circle mr-1"></i> Abandonner
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
