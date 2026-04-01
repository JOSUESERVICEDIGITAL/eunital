@extends('back.formation.layouts.app')

@section('title', $chapitre->titre)
@section('page_title', $chapitre->titre)
@section('page_subtitle', 'Détails du chapitre et liste des contenus')

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
                        <a href="{{ route('back.formation.cours.show', $chapitre->cour) }}" class="text-info">
                            <i class="fas fa-book"></i> {{ $chapitre->cour->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-4">Position</dt>
                    <dd class="col-sm-8">
                        <span class="badge badge-secondary">Chapitre {{ $chapitre->ordre + 1 }}</span>
                    </dd>
                    
                    <dt class="col-sm-4">Durée estimée</dt>
                    <dd class="col-sm-8">
                        @if($chapitre->duree_estimee)
                            <i class="fas fa-clock"></i> {{ $chapitre->duree_estimee }} minutes
                        @else
                            <span class="text-muted">Non définie</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Accès</dt>
                    <dd class="col-sm-8">
                        @if($chapitre->is_free)
                            <span class="badge badge-success">
                                <i class="fas fa-gift"></i> Gratuit
                            </span>
                        @else
                            <span class="badge badge-secondary">
                                <i class="fas fa-lock"></i> Payant
                            </span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Créé le</dt>
                    <dd class="col-sm-8">{{ $chapitre->created_at->format('d/m/Y H:i') }}</dd>
                    
                    <dt class="col-sm-4">Modifié le</dt>
                    <dd class="col-sm-8">{{ $chapitre->updated_at->format('d/m/Y H:i') }}</dd>
                </dl>
                
                <hr>
                
                <h6>Description</h6>
                <p class="text-muted">{{ $chapitre->description ?? 'Aucune description' }}</p>
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.chapitres.edit', $chapitre) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="{{ route('back.formation.cours.show', $chapitre->cour) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour au cours
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
                    <div class="col-12">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Contenus pédagogiques</span>
                                <span class="info-box-number">{{ $chapitre->contenus->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if($chapitre->contenus->count() > 0)
                    <div class="mt-3">
                        <h6>Répartition des contenus :</h6>
                        @php
                            $types = $chapitre->contenus->groupBy('type');
                        @endphp
                        @foreach($types as $type => $contenus)
                            <div class="d-flex justify-content-between mb-1">
                                <span>
                                    @switch($type)
                                        @case('video')
                                            <i class="fas fa-video text-danger"></i> Vidéos
                                            @break
                                        @case('document')
                                            <i class="fas fa-file-alt text-primary"></i> Documents
                                            @break
                                        @case('image')
                                            <i class="fas fa-image text-success"></i> Images
                                            @break
                                        @case('audio')
                                            <i class="fas fa-headphones text-warning"></i> Audios
                                            @break
                                        @case('quiz')
                                            <i class="fas fa-puzzle-piece text-info"></i> Quiz
                                            @break
                                        @case('exercice')
                                            <i class="fas fa-code text-secondary"></i> Exercices
                                            @break
                                        @case('tutoriel')
                                            <i class="fas fa-chalkboard text-purple"></i> Tutoriels
                                            @break
                                    @endswitch
                                </span>
                                <span class="badge badge-primary">{{ $contenus->count() }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt mr-2"></i>
                    Contenus du chapitre
                </h3>
                <div class="card-tools">
                    <a href="{{ route('back.formation.contenus.create', ['chapitre_id' => $chapitre->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Ajouter un contenu
                    </a>
                    <button type="button" class="btn btn-default btn-sm" onclick="reorderContenus()">
                        <i class="fas fa-arrows-alt"></i> Réordonner
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @if($chapitre->contenus->count() > 0)
                    <div class="list-group list-group-flush sortable-list" id="contenus-list">
                        @foreach($chapitre->contenus as $index => $contenu)
                        <div class="list-group-item" data-id="{{ $contenu->id }}" data-order="{{ $contenu->ordre }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="drag-handle mr-2" style="cursor: move;">
                                            <i class="fas fa-grip-vertical text-muted"></i>
                                        </span>
                                        <span class="badge badge-secondary mr-2">{{ $index + 1 }}</span>
                                        @switch($contenu->type)
                                            @case('video')
                                                <i class="fas fa-video text-danger fa-lg mr-2"></i>
                                                @break
                                            @case('document')
                                                <i class="fas fa-file-alt text-primary fa-lg mr-2"></i>
                                                @break
                                            @case('image')
                                                <i class="fas fa-image text-success fa-lg mr-2"></i>
                                                @break
                                            @case('audio')
                                                <i class="fas fa-headphones text-warning fa-lg mr-2"></i>
                                                @break
                                            @case('quiz')
                                                <i class="fas fa-puzzle-piece text-info fa-lg mr-2"></i>
                                                @break
                                            @case('exercice')
                                                <i class="fas fa-code text-secondary fa-lg mr-2"></i>
                                                @break
                                            @case('tutoriel')
                                                <i class="fas fa-chalkboard text-purple fa-lg mr-2"></i>
                                                @break
                                        @endswitch
                                        <h5 class="mb-0">
                                            <a href="{{ route('back.formation.contenus.show', $contenu) }}" class="text-dark">
                                                {{ $contenu->titre }}
                                            </a>
                                        </h5>
                                        @if($contenu->telechargeable)
                                            <span class="badge badge-info ml-2">
                                                <i class="fas fa-download"></i> Téléchargeable
                                            </span>
                                        @endif
                                        @if(!$contenu->is_visible)
                                            <span class="badge badge-secondary ml-2">
                                                <i class="fas fa-eye-slash"></i> Masqué
                                            </span>
                                        @endif
                                    </div>
                                    <p class="mb-2 text-muted">{{ Str::limit($contenu->contenu, 100) }}</p>
                                    @if($contenu->fichier)
                                        <small class="text-muted">
                                            <i class="fas fa-file"></i> {{ basename($contenu->fichier) }}
                                            @if($contenu->taille_formatee)
                                                ({{ $contenu->taille_formatee }})
                                            @endif
                                        </small>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    @include('back.formation.partials.table-actions', [
                                        'showRoute' => route('back.formation.contenus.show', $contenu),
                                        'editRoute' => route('back.formation.contenus.edit', $contenu),
                                        'deleteRoute' => route('back.formation.contenus.destroy', $contenu),
                                        'customActions' => '
                                            <button type="button" class="btn btn-sm btn-' . ($contenu->is_visible ? 'warning' : 'success') . '" 
                                                    onclick="toggleVisibility(' . $contenu->id . ', ' . ($contenu->is_visible ? 'false' : 'true') . ')" 
                                                    title="' . ($contenu->is_visible ? 'Masquer' : 'Afficher') . '">
                                                <i class="fas fa-' . ($contenu->is_visible ? 'eye-slash' : 'eye') . '"></i>
                                            </button>
                                        '
                                    ])
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun contenu n'a encore été ajouté à ce chapitre</p>
                        <a href="{{ route('back.formation.contenus.create', ['chapitre_id' => $chapitre->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Ajouter le premier contenu
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        @if($chapitre->contenus->count() > 0 && $chapitre->contenus->where('type', 'quiz')->count() > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Performance des quiz
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Quiz</th>
                                <th>Soumissions</th>
                                <th>Note moyenne</th>
                                <th>Taux de réussite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chapitre->contenus->where('type', 'quiz') as $quiz)
                            <tr>
                                <td>{{ $quiz->titre }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $quiz->soumissions_count ?? 0 }}</span>
                                </td>
                                <td>
                                    @if(($quiz->note_moyenne ?? 0) > 0)
                                        {{ round($quiz->note_moyenne, 1) }}/20
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if(($quiz->taux_reussite ?? 0) > 0)
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" style="width: {{ $quiz->taux_reussite }}%">
                                                {{ round($quiz->taux_reussite, 1) }}%
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    function toggleVisibility(id, show) {
        $.ajax({
            url: '/back/formation/contenus/' + id + '/toggle-visibility',
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
    
    @if($chapitre->contenus->count() > 0)
    // Réordonner les contenus
    var sortable = new Sortable(document.getElementById('contenus-list'), {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function() {
            var items = [];
            document.querySelectorAll('#contenus-list .list-group-item').forEach(function(item, index) {
                items.push({
                    id: item.dataset.id,
                    ordre: index
                });
            });
            
            $.ajax({
                url: '{{ route("back.formation.contenus.reorder") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    contenus: items
                },
                success: function(response) {
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Réordonnancement',
                            text: 'L\'ordre des contenus a été mis à jour',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
    });
    @endif
    
    function reorderContenus() {
        Swal.fire({
            title: 'Réordonner les contenus',
            text: 'Faites glisser les contenus pour les réorganiser',
            icon: 'info',
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>
@endpush