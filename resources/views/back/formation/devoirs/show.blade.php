@extends('back.formation.layouts.app')

@section('title', $devoir->titre)
@section('page_title', $devoir->titre)
@section('page_subtitle', 'Détails du devoir et suivi des soumissions')

@section('formation-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations générales
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Cours</dt>
                    <dd class="col-sm-8">
                        <a href="{{ route('back.formation.cours.show', $devoir->cour) }}" class="text-info">
                            {{ $devoir->cour->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-4">Type</dt>
                    <dd class="col-sm-8">
                        @include('back.formation.partials.status-badge', ['status' => $devoir->type])
                    </dd>
                    
                    <dt class="col-sm-4">Note maximale</dt>
                    <dd class="col-sm-8">
                        <span class="badge badge-primary">{{ $devoir->note_maximale }}/{{ $devoir->note_maximale }}</span>
                    </dd>
                    
                    <dt class="col-sm-4">Date limite</dt>
                    <dd class="col-sm-8">
                        @if($devoir->date_limite)
                            {{ \Carbon\Carbon::parse($devoir->date_limite)->format('d/m/Y H:i') }}
                            @if($devoir->est_expire)
                                <span class="badge badge-danger ml-2">Expiré</span>
                            @endif
                        @else
                            <span class="text-muted">Aucune limite</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Durée limite</dt>
                    <dd class="col-sm-8">
                        @if($devoir->duree_limite)
                            {{ floor($devoir->duree_limite / 60) }}h {{ $devoir->duree_limite % 60 }}min
                        @else
                            <span class="text-muted">Illimitée</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Statut</dt>
                    <dd class="col-sm-8">
                        @if($devoir->is_published)
                            <span class="badge badge-success">Publié</span>
                        @else
                            <span class="badge badge-secondary">Brouillon</span>
                        @endif
                    </dd>
                </dl>
                
                <hr>
                
                <h6>Description</h6>
                <p class="text-muted">{{ $devoir->description }}</p>
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.devoirs.edit', $devoir) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    @if(!$devoir->is_published)
                        <button type="button" class="btn btn-success" onclick="publierDevoir({{ $devoir->id }})">
                            <i class="fas fa-eye"></i> Publier
                        </button>
                    @endif
                    <a href="{{ route('back.formation.devoirs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple mr-2"></i>
                    Statistiques
                </h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Soumissions</span>
                                <span class="info-box-number">{{ $stats['total_soumissions'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">À corriger</span>
                                <span class="info-box-number">{{ $stats['soumissions_non_corrigees'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Corrigés</span>
                                <span class="info-box-number">{{ $stats['soumissions_corrigees'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Note moyenne</span>
                                <span class="info-box-number">{{ round($stats['moyenne'], 1) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress-group">
                            <span class="progress-text">Taux de soumission</span>
                            <span class="progress-number"><b>{{ $stats['taux_soumission'] }}%</b></span>
                            <div class="progress">
                                <div class="progress-bar bg-primary" style="width: {{ $stats['taux_soumission'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Ressources jointes
                </h3>
            </div>
            <div class="card-body">
                @if($devoir->resources && count($devoir->resources) > 0)
                    <div class="list-group">
                        @foreach($devoir->resources as $index => $resource)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-alt mr-2 text-primary"></i>
                                    <strong>{{ $resource['name'] }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        @if(isset($resource['size']))
                                            {{ number_format($resource['size'] / 1024, 2) }} KB
                                        @endif
                                        @if(isset($resource['type']))
                                            - {{ $resource['type'] }}
                                        @endif
                                    </small>
                                </div>
                                <a href="{{ asset('storage/' . $resource['path']) }}" class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-paperclip fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucune ressource jointe</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    Soumissions des étudiants
                </h3>
                <div class="card-tools">
                    <a href="{{ route('back.formation.soumissions.a-corriger', ['devoir' => $devoir->id]) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-check-double"></i> Corriger ({{ $stats['soumissions_non_corrigees'] }})
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($devoir->soumissions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                 <tr>
                                    <th>Étudiant</th>
                                    <th>Soumis le</th>
                                    <th>Note</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devoir->soumissions as $soumission)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                                {{ substr($soumission->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <strong>{{ $soumission->user->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $soumission->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $soumission->soumis_le->format('d/m/Y H:i') }}
                                        @if($soumission->est_en_retard)
                                            <span class="badge badge-danger">En retard</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($soumission->note)
                                            <span class="badge badge-{{ $soumission->note >= ($devoir->note_maximale * 0.6) ? 'success' : 'warning' }}">
                                                {{ $soumission->note }}/{{ $devoir->note_maximale }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">En attente</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($soumission->est_corrige)
                                            <span class="badge badge-success">Corrigé</span>
                                        @else
                                            <span class="badge badge-warning">À corriger</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('back.formation.soumissions.show', $soumission) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(!$soumission->est_corrige)
                                            <a href="{{ route('back.formation.soumissions.show', $soumission) }}#correction" class="btn btn-sm btn-warning">
                                                <i class="fas fa-check-double"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucune soumission pour le moment</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function publierDevoir(id) {
        $.ajax({
            url: '/back/formation/devoirs/' + id + '/publier',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PATCH'
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire('Publié!', 'Le devoir a été publié', 'success');
                    location.reload();
                }
            }
        });
    }
</script>
@endpush