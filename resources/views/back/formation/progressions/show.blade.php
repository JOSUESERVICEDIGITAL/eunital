@extends('back.formation.layouts.app')

@section('title', 'Détails de la progression')
@section('page_title', 'Progression de ' . $progression->user->name)
@section('page_subtitle', $progression->cour->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-5">Étudiant</dt>
                    <dd class="col-sm-7">
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle mr-2" style="width: 40px; height: 40px;">
                                {{ substr($progression->user->name, 0, 1) }}
                            </div>
                            <div>
                                <strong>{{ $progression->user->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $progression->user->email }}</small>
                            </div>
                        </div>
                    </dd>
                    
                    <dt class="col-sm-5">Cours</dt>
                    <dd class="col-sm-7">
                        <a href="{{ route('back.formation.cours.show', $progression->cour) }}" class="text-info">
                            {{ $progression->cour->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-5">Module</dt>
                    <dd class="col-sm-7">{{ $progression->cour->module->titre ?? 'N/A' }}</dd>
                    
                    <dt class="col-sm-5">Progression</dt>
                    <dd class="col-sm-7">
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-{{ $progression->progression >= 100 ? 'success' : 'primary' }}" 
                                 style="width: {{ $progression->progression }}%">
                                {{ $progression->progression }}%
                            </div>
                        </div>
                    </dd>
                    
                    <dt class="col-sm-5">Statut</dt>
                    <dd class="col-sm-7">
                        @if($progression->termine)
                            <span class="badge badge-success">Terminé</span>
                        @elseif($progression->progression > 0)
                            <span class="badge badge-primary">En cours</span>
                        @else
                            <span class="badge badge-secondary">Non commencé</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-5">Dernier accès</dt>
                    <dd class="col-sm-7">
                        {{ $progression->dernier_acces ? \Carbon\Carbon::parse($progression->dernier_acces)->format('d/m/Y H:i') : '-' }}
                        <br>
                        <small class="text-muted">il y a {{ \Carbon\Carbon::parse($progression->dernier_acces)->diffForHumans() }}</small>
                    </dd>
                </dl>
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.progressions.edit', $progression) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <button type="button" class="btn btn-danger" onclick="resetProgression({{ $progression->id }})">
                        <i class="fas fa-undo"></i> Réinitialiser
                    </button>
                    <a href="{{ route('back.formation.progressions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-layer-group mr-2"></i>
                    Avancement dans les chapitres
                </h3>
            </div>
            <div class="card-body">
                @php
                    $chapitres = $progression->cour->chapitres;
                    $chapitreActuel = $progression->chapitre;
                @endphp
                
                @foreach($chapitres as $index => $chapitre)
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <span class="badge badge-secondary mr-2">Chapitre {{ $index + 1 }}</span>
                            <strong>{{ $chapitre->titre }}</strong>
                            @if($chapitreActuel && $chapitreActuel->id == $chapitre->id)
                                <span class="badge badge-warning ml-2">En cours</span>
                            @endif
                        </div>
                        <div>
                            @php
                                $contenusTotal = $chapitre->contenus->count();
                                $contenusCompletes = $progression->metadatas[$chapitre->id] ?? 0;
                                $progressionChapitre = $contenusTotal > 0 ? ($contenusCompletes / $contenusTotal) * 100 : 0;
                            @endphp
                            <span class="small">{{ round($progressionChapitre) }}%</span>
                        </div>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-{{ $progressionChapitre >= 100 ? 'success' : 'info' }}" 
                             style="width: {{ $progressionChapitre }}%">
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">
                            {{ $contenusCompletes }} / {{ $contenusTotal }} contenus complétés
                        </small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-history mr-2"></i>
                    Historique d'activité
                </h3>
            </div>
            <div class="card-body p-0">
                @if($progression->metadatas && isset($progression->metadatas['historique']))
                    <div class="timeline">
                        @foreach($progression->metadatas['historique'] as $activite)
                        <div>
                            <i class="fas fa-play bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($activite['date'])->format('d/m/Y H:i') }}
                                </span>
                                <div class="timeline-body">
                                    {{ $activite['message'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-history fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucun historique d'activité</p>
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
</style>
@endpush

@push('scripts')
<script>
    function resetProgression(id) {
        Swal.fire({
            title: 'Réinitialiser la progression',
            text: 'Cette action remettra la progression à 0. L\'étudiant devra recommencer le cours.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/progressions/' + id + '/reset',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Réinitialisé!', 'La progression a été réinitialisée', 'success');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endpush