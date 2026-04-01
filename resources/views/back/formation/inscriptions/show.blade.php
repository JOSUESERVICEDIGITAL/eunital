@extends('back.formation.layouts.app')

@section('title', 'Détails inscription')
@section('page_title', 'Détails de l\'inscription')
@section('page_subtitle', 'Suivi de l\'inscription de ' . $inscription->user->name . ' au module ' . $inscription->module->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-graduate mr-2"></i>
                    Informations étudiant
                </h3>
            </div>
            <div class="card-body text-center">
                <div class="avatar-circle mx-auto mb-3" style="width: 80px; height: 80px; font-size: 32px;">
                    {{ substr($inscription->user->name, 0, 1) }}
                </div>
                <h4>{{ $inscription->user->name }}</h4>
                <p class="text-muted">{{ $inscription->user->email }}</p>
                
                <hr>
                
                <dl class="text-left">
                    <dt>Inscrit le</dt>
                    <dd>{{ $inscription->created_at->format('d/m/Y H:i') }}</dd>
                    
                    @if($inscription->date_debut)
                    <dt>Début du module</dt>
                    <dd>{{ \Carbon\Carbon::parse($inscription->date_debut)->format('d/m/Y') }}</dd>
                    @endif
                    
                    @if($inscription->date_fin)
                    <dt>Fin du module</dt>
                    <dd>{{ \Carbon\Carbon::parse($inscription->date_fin)->format('d/m/Y') }}</dd>
                    @endif
                    
                    <dt>Statut</dt>
                    <dd>@include('back.formation.partials.status-badge', ['status' => $inscription->statut])</dd>
                    
                    <dt>Dernière activité</dt>
                    <dd>{{ $inscription->derniere_activite ? \Carbon\Carbon::parse($inscription->derniere_activite)->format('d/m/Y H:i') : 'Aucune activité' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.inscriptions.edit', $inscription) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple mr-2"></i>
                    Progression
                </h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="easypiechart" data-percent="{{ $inscription->progression }}" style="width: 150px; margin: 0 auto;">
                        <span class="h2">{{ $inscription->progression }}%</span>
                    </div>
                </div>
                
                <div class="progress-group mt-3">
                    <span class="progress-text">Progression globale</span>
                    <span class="progress-number"><b>{{ $inscription->progression }}%</b></span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width: {{ $inscription->progression }}%"></div>
                    </div>
                </div>
                
                <div class="progress-group mt-2">
                    <span class="progress-text">Taux de présence</span>
                    <span class="progress-number"><b>{{ round($inscription->taux_presence, 1) }}%</b></span>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $inscription->taux_presence }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Performance
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-8">Note moyenne devoirs</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-info">{{ round($noteMoyenne ?? 0, 1) }}/20</span>
                    </dd>
                    
                    <dt class="col-sm-8">Devoirs rendus</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-success">{{ $devoirsRendus ?? 0 }}/{{ $totalDevoirs ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-8">Quiz réussis</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-warning">{{ $quizReussis ?? 0 }}/{{ $totalQuiz ?? 0 }}</span>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book mr-2"></i>
                    Cours du module
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($inscription->module->cours as $index => $cour)
                    @php
                        $progressionCour = $progressions->where('cour_id', $cour->id)->first();
                        $progressionValue = $progressionCour ? $progressionCour->progression : 0;
                        $termine = $progressionCour ? $progressionCour->termine : false;
                    @endphp
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge badge-secondary mr-2">Cours {{ $index + 1 }}</span>
                                    <h5 class="mb-0">
                                        <a href="{{ route('back.formation.cours.show', $cour) }}" class="text-dark">
                                            {{ $cour->titre }}
                                        </a>
                                    </h5>
                                    @if($termine)
                                        <span class="badge badge-success ml-2">
                                            <i class="fas fa-check-circle"></i> Terminé
                                        </span>
                                    @endif
                                </div>
                                <p class="mb-2 text-muted">{{ Str::limit($cour->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="progress flex-grow-1 mr-3" style="height: 8px;">
                                        <div class="progress-bar bg-{{ $progressionValue >= 100 ? 'success' : 'primary' }}" 
                                             style="width: {{ $progressionValue }}%">
                                        </div>
                                    </div>
                                    <span class="small">{{ $progressionValue }}%</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <a href="{{ route('back.formation.cours.show', $cour) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Historique des présences
                </h3>
            </div>
            <div class="card-body p-0">
                @if($inscription->presences->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                    <th>Cours</th>
                                    <th>Date</th>
                                    <th>Heure début</th>
                                    <th>Durée</th>
                                    <th>Statut</th>
                                </thead>
                                <tbody>
                                    @foreach($inscription->presences as $presence)
                                    <tr>
                                        <td>
                                            <a href="{{ route('back.formation.cours.show', $presence->cour) }}" class="text-info">
                                                {{ $presence->cour->titre }}
                                            </a>
                                        </td>
                                        <td>{{ $presence->date_debut ? \Carbon\Carbon::parse($presence->date_debut)->format('d/m/Y') : '-' }}</td>
                                        <td>{{ $presence->date_debut ? \Carbon\Carbon::parse($presence->date_debut)->format('H:i') : '-' }}</td>
                                        <td>{{ $presence->duree_formatee }}</td>
                                        <td>
                                            @if($presence->present)
                                                <span class="badge badge-success">Présent</span>
                                            @else
                                                <span class="badge badge-danger">Absent</span>
                                            @endif
                                            @if($presence->statut != 'present' && $presence->statut != 'absent')
                                                <br>
                                                <small class="text-muted">{{ $presence->statut }}</small>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-check fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Aucune présence enregistrée pour le moment</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tasks mr-2"></i>
                    Devoirs et évaluations
                </h3>
            </div>
            <div class="card-body p-0">
                @php
                    $devoirsEtudiant = $inscription->user->soumissionsDevoirs()
                        ->whereHas('devoir.cour.module', function($q) use ($inscription) {
                            $q->where('id', $inscription->module_id);
                        })
                        ->get();
                @endphp
                
                @if($devoirsEtudiant->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                 <tr>
                                    <th>Devoir</th>
                                    <th>Cours</th>
                                    <th>Soumis le</th>
                                    <th>Note</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devoirsEtudiant as $soumission)
                                <tr>
                                    <td>
                                        <strong>{{ $soumission->devoir->titre }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $soumission->devoir->type }}</small>
                                    </td>
                                    <td>{{ $soumission->devoir->cour->titre }}</td>
                                    <td>{{ $soumission->soumis_le->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($soumission->note)
                                            <span class="badge badge-{{ $soumission->note >= ($soumission->devoir->note_maximale * 0.6) ? 'success' : 'warning' }}">
                                                {{ $soumission->note }}/{{ $soumission->devoir->note_maximale }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">En attente</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($soumission->est_en_retard)
                                            <span class="badge badge-danger">En retard</span>
                                        @elseif($soumission->note)
                                            <span class="badge badge-success">Corrigé</span>
                                        @else
                                            <span class="badge badge-warning">À corriger</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('back.formation.soumissions.show', $soumission) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-tasks fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucun devoir soumis pour le moment</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comments mr-2"></i>
                    Activité récente
                </h3>
            </div>
            <div class="card-body">
                @php
                    $activites = collect();
                    
                    // Ajouter les présences
                    foreach($inscription->presences as $presence) {
                        $activites->push([
                            'date' => $presence->created_at,
                            'type' => 'presence',
                            'message' => 'Présence enregistrée pour le cours "' . $presence->cour->titre . '"',
                            'icon' => 'fa-calendar-check',
                            'color' => 'success'
                        ]);
                    }
                    
                    // Ajouter les soumissions
                    foreach($devoirsEtudiant as $soumission) {
                        $activites->push([
                            'date' => $soumission->soumis_le,
                            'type' => 'soumission',
                            'message' => 'Soumission du devoir "' . $soumission->devoir->titre . '"',
                            'icon' => 'fa-upload',
                            'color' => 'info'
                        ]);
                    }
                    
                    // Ajouter les corrections
                    foreach($devoirsEtudiant->whereNotNull('note') as $soumission) {
                        $activites->push([
                            'date' => $soumission->note_le,
                            'type' => 'correction',
                            'message' => 'Correction du devoir "' . $soumission->devoir->titre . '" - Note: ' . $soumission->note . '/' . $soumission->devoir->note_maximale,
                            'icon' => 'fa-check-circle',
                            'color' => 'primary'
                        ]);
                    }
                    
                    $activites = $activites->sortByDesc('date')->take(10);
                @endphp
                
                @if($activites->count() > 0)
                    <div class="timeline">
                        @foreach($activites as $activite)
                        <div>
                            <i class="fas {{ $activite['icon'] }} bg-{{ $activite['color'] }}"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="fas fa-clock"></i> 
                                    {{ \Carbon\Carbon::parse($activite['date'])->format('d/m/Y H:i') }}
                                </span>
                                <h3 class="timeline-header">
                                    {{ ucfirst($activite['type']) }}
                                </h3>
                                <div class="timeline-body">
                                    {{ $activite['message'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-clock fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucune activité récente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .timeline {
        position: relative;
        margin: 0 0 30px 0;
        padding: 0;
        list-style: none;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #ddd;
        left: 31px;
        margin: 0;
        border-radius: 2px;
    }
    
    .timeline > div {
        position: relative;
        margin-bottom: 15px;
    }
    
    .timeline > div .timeline-item {
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        border-radius: 3px;
        margin-top: 0;
        background: #fff;
        color: #444;
        margin-left: 60px;
        margin-right: 15px;
        padding: 0;
        position: relative;
    }
    
    .timeline > div .timeline-item .time {
        color: #999;
        float: right;
        padding: 10px;
        font-size: 12px;
    }
    
    .timeline > div .timeline-item .timeline-header {
        margin: 0;
        color: #555;
        border-bottom: 1px solid #f4f4f4;
        padding: 10px;
        font-size: 16px;
        line-height: 1.1;
    }
    
    .timeline > div .timeline-item .timeline-body {
        padding: 10px;
    }
    
    .timeline > div > i {
        position: absolute;
        background: #d2d6de;
        border-radius: 50%;
        height: 30px;
        width: 30px;
        text-align: center;
        line-height: 30px;
        font-size: 16px;
        color: #fff;
        left: 18px;
        top: 0;
        z-index: 1;
    }
    
    .easypiechart {
        position: relative;
        text-align: center;
    }
    
    .easypiechart .h2 {
        margin-left: 10px;
        margin-top: 10px;
        display: inline-block;
        height: 110px;
        width: 110px;
        text-align: center;
        border: 8px solid #f4f4f4;
        border-radius: 50%;
        line-height: 94px;
    }
    
    .avatar-circle {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 32px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/easy-pie-chart@2.1.6/dist/jquery.easypiechart.min.js"></script>
<script>
    $(document).ready(function() {
        // Easy pie chart pour la progression
        $('.easypiechart').easyPieChart({
            scaleColor: false,
            trackColor: '#f4f4f4',
            barColor: '#007bff',
            lineWidth: 8,
            size: 150,
            animate: 1000
        });
    });
</script>
@endpush