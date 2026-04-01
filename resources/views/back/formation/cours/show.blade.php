@extends('back.formation.layouts.app')

@section('title', $cour->titre)
@section('page_title', $cour->titre)
@section('page_subtitle', 'Détails du cours et structure pédagogique')

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
                @if($cour->image_couverture)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/' . $cour->image_couverture) }}" 
                             alt="{{ $cour->titre }}" 
                             class="img-fluid rounded" 
                             style="max-height: 200px;">
                    </div>
                @endif
                
                <dl class="row">
                    <dt class="col-sm-4">Module</dt>
                    <dd class="col-sm-8">
                        <a href="{{ route('back.formation.modules.show', $cour->module) }}" class="text-info">
                            {{ $cour->module->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-4">Niveau</dt>
                    <dd class="col-sm-8">
                        @include('back.formation.partials.status-badge', ['status' => $cour->niveau_difficulte])
                    </dd>
                    
                    <dt class="col-sm-4">Durée</dt>
                    <dd class="col-sm-8">
                        <i class="fas fa-clock"></i> {{ $cour->duree_estimee ?? 0 }} minutes
                    </dd>
                    
                    <dt class="col-sm-4">Statut</dt>
                    <dd class="col-sm-8">
                        @include('back.formation.partials.status-badge', ['status' => $cour->is_published ? 'publie' : 'brouillon'])
                    </dd>
                    
                    @if($cour->published_at)
                    <dt class="col-sm-4">Publié le</dt>
                    <dd class="col-sm-8">{{ $cour->published_at->format('d/m/Y H:i') }}</dd>
                    @endif
                </dl>
                
                <hr>
                
                <h6>Description</h6>
                <p class="text-muted">{{ $cour->description }}</p>
                
                @if($cour->objectifs)
                <hr>
                <h6>Objectifs pédagogiques</h6>
                <p class="text-muted">{{ $cour->objectifs }}</p>
                @endif
                
                @if($cour->pre_requis)
                <hr>
                <h6>Prérequis</h6>
                <p class="text-muted">{{ $cour->pre_requis }}</p>
                @endif
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.cours.edit', $cour) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    @if($cour->is_published)
                        <button type="button" class="btn btn-warning" onclick="togglePublish({{ $cour->id }}, false)">
                            <i class="fas fa-eye-slash"></i> Dépublier
                        </button>
                    @else
                        <button type="button" class="btn btn-success" onclick="togglePublish({{ $cour->id }}, true)">
                            <i class="fas fa-eye"></i> Publier
                        </button>
                    @endif
                </div>
                <div class="mt-2">
                    <a href="{{ route('back.formation.modules.show', $cour->module) }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left"></i> Retour au module
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
                                <span class="info-box-text">Chapitres</span>
                                <span class="info-box-number">{{ $stats['nb_chapitres'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Contenus</span>
                                <span class="info-box-number">{{ $stats['nb_contenus'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Étudiants</span>
                                <span class="info-box-number">{{ $stats['nb_etudiants'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Note moyenne</span>
                                <span class="info-box-number">{{ round($stats['note_moyenne'], 1) }}/20</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress-group">
                            <span class="progress-text">Progression moyenne</span>
                            <span class="progress-number"><b>{{ round($stats['progression_moyenne'], 1) }}%</b></span>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-primary" style="width: {{ $stats['progression_moyenne'] }}%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">Taux de complétion</span>
                            <span class="progress-number"><b>{{ round($stats['taux_completion'], 1) }}%</b></span>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: {{ $stats['taux_completion'] }}%"></div>
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
                    <i class="fas fa-layer-group mr-2"></i>
                    Structure du cours
                </h3>
                <div class="card-tools">
                    <a href="{{ route('back.formation.chapitres.create', ['cour_id' => $cour->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Ajouter un chapitre
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($cour->chapitres->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($cour->chapitres as $index => $chapitre)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-secondary mr-2">Chapitre {{ $index + 1 }}</span>
                                        <h5 class="mb-0">
                                            <a href="{{ route('back.formation.chapitres.show', $chapitre) }}" class="text-dark">
                                                {{ $chapitre->titre }}
                                            </a>
                                        </h5>
                                    </div>
                                    <p class="mb-2 text-muted">{{ Str::limit($chapitre->description, 100) }}</p>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge badge-info mr-2">
                                            <i class="fas fa-file-alt"></i> {{ $chapitre->contenus->count() }} contenus
                                        </span>
                                        @if($chapitre->duree_estimee)
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock"></i> {{ $chapitre->duree_estimee }} min
                                        </span>
                                        @endif
                                        @if($chapitre->is_free)
                                        <span class="badge badge-success ml-2">
                                            <i class="fas fa-gift"></i> Gratuit
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-3">
                                    @include('back.formation.partials.table-actions', [
                                        'showRoute' => route('back.formation.chapitres.show', $chapitre),
                                        'editRoute' => route('back.formation.chapitres.edit', $chapitre),
                                        'deleteRoute' => route('back.formation.chapitres.destroy', $chapitre)
                                    ])
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-layer-group fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun chapitre n'a encore été ajouté à ce cours</p>
                        <a href="{{ route('back.formation.chapitres.create', ['cour_id' => $cour->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Ajouter le premier chapitre
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                    Enseignants
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addTeacherModal">
                        <i class="fas fa-plus"></i> Ajouter un enseignant
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @if($cour->enseignants->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($cour->enseignants as $enseignant)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle mr-2" style="width: 40px; height: 40px;">
                                            {{ substr($enseignant->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <strong>{{ $enseignant->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $enseignant->email }}</small>
                                            <br>
                                            <span class="badge badge-info">{{ $enseignant->pivot->role == 'principal' ? 'Enseignant principal' : 'Assistant' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('back.formation.cours.retirer-enseignant', [$cour, $enseignant]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Retirer">
                                        <i class="fas fa-user-minus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-chalkboard-teacher fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucun enseignant assigné à ce cours</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tasks mr-2"></i>
                    Devoirs
                </h3>
                <div class="card-tools">
                    <a href="{{ route('back.formation.devoirs.create', ['cour_id' => $cour->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Ajouter un devoir
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($cour->devoirs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Date limite</th>
                                    <th>Soumissions</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach($cour->devoirs as $devoir)
                                    <tr>
                                        <td>
                                            <strong>{{ $devoir->titre }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($devoir->description, 50) }}</small>
                                        </td>
                                        <td>
                                            @include('back.formation.partials.status-badge', ['status' => $devoir->type])
                                        </td>
                                        <td>
                                            @if($devoir->date_limite)
                                                {{ $devoir->date_limite->format('d/m/Y H:i') }}
                                                @if($devoir->est_expire)
                                                    <span class="badge badge-danger">Expiré</span>
                                                @endif
                                            @else
                                                <span class="text-muted">Aucune</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $devoir->soumissions_count }}</span>
                                            @if($devoir->nb_soumissions_non_corrigees > 0)
                                                <span class="badge badge-warning">{{ $devoir->nb_soumissions_non_corrigees }} à corriger</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('back.formation.devoirs.show', $devoir) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('back.formation.soumissions.a-corriger', ['devoir' => $devoir->id]) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-check-double"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-tasks fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Aucun devoir pour ce cours</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajouter Enseignant -->
<div class="modal fade" id="addTeacherModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('back.formation.cours.ajouter-enseignant', $cour) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un enseignant</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enseignant</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">Sélectionner un enseignant</option>
                            @foreach($enseignants as $enseignant)
                            <option value="{{ $enseignant->id }}">{{ $enseignant->name }} ({{ $enseignant->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rôle</label>
                        <select name="role" class="form-control">
                            <option value="principal">Enseignant principal</option>
                            <option value="assistant">Assistant</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePublish(id, publish) {
        $.ajax({
            url: '/back/formation/cours/' + id + '/' + (publish ? 'publier' : 'depublier'),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PATCH'
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            }
        });
    }
</script>
@endpush