@extends('back.formation.layouts.app')

@section('title', $contenu->titre)
@section('page_title', $contenu->titre)
@section('page_subtitle', 'Détails du contenu pédagogique')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @switch($contenu->type)
                        @case('video')
                            <i class="fas fa-video text-danger mr-2"></i>
                            @break
                        @case('document')
                            <i class="fas fa-file-alt text-primary mr-2"></i>
                            @break
                        @case('image')
                            <i class="fas fa-image text-success mr-2"></i>
                            @break
                        @case('audio')
                            <i class="fas fa-headphones text-warning mr-2"></i>
                            @break
                        @case('quiz')
                            <i class="fas fa-puzzle-piece text-info mr-2"></i>
                            @break
                        @case('exercice')
                            <i class="fas fa-code text-secondary mr-2"></i>
                            @break
                        @case('tutoriel')
                            <i class="fas fa-chalkboard text-purple mr-2"></i>
                            @break
                    @endswitch
                    {{ $contenu->titre }}
                </h3>
                <div class="card-tools">
                    @if($contenu->fichier && $contenu->telechargeable)
                        <a href="{{ route('back.formation.contenus.download', $contenu) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Télécharger
                        </a>
                    @endif
                    <a href="{{ route('back.formation.contenus.edit', $contenu) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($contenu->type == 'video' && $contenu->fichier)
                    @php
                        $ext = pathinfo($contenu->fichier, PATHINFO_EXTENSION);
                    @endphp
                    <div class="embed-responsive embed-responsive-16by9 mb-4">
                        @if(in_array($ext, ['mp4', 'webm', 'ogg']))
                            <video class="embed-responsive-item" controls>
                                <source src="{{ asset('storage/' . $contenu->fichier) }}" type="video/{{ $ext }}">
                            </video>
                        @else
                            <div class="text-center py-5 bg-dark">
                                <i class="fas fa-video fa-5x text-white"></i>
                                <p class="text-white mt-2">Aperçu non disponible</p>
                            </div>
                        @endif
                    </div>
                @endif
                
                @if($contenu->type == 'image' && $contenu->fichier)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $contenu->fichier) }}" alt="{{ $contenu->titre }}" class="img-fluid rounded">
                    </div>
                @endif
                
                @if($contenu->type == 'audio' && $contenu->fichier)
                    <div class="mb-4">
                        <audio controls class="w-100">
                            <source src="{{ asset('storage/' . $contenu->fichier) }}" type="audio/mpeg">
                        </audio>
                    </div>
                @endif
                
                @if($contenu->type == 'document' && $contenu->fichier)
                    <div class="alert alert-info">
                        <i class="fas fa-file-pdf"></i>
                        <strong>Document :</strong> {{ basename($contenu->fichier) }}
                        <br>
                        <small>Taille : {{ $contenu->taille_formatee }}</small>
                        <br>
                        <a href="{{ route('back.formation.contenus.download', $contenu) }}" class="btn btn-sm btn-primary mt-2">
                            <i class="fas fa-download"></i> Télécharger le document
                        </a>
                    </div>
                @endif
                
                <div class="mt-4">
                    <h5>Description</h5>
                    <div class="well well-sm bg-light p-3 rounded">
                        {!! nl2br(e($contenu->contenu)) !!}
                    </div>
                </div>
                
                @if($contenu->type == 'quiz')
                <div class="mt-4">
                    <h5>Questions du quiz</h5>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        Les questions sont gérées dans la section dédiée aux quiz.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
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
                    <dt class="col-sm-5">Type</dt>
                    <dd class="col-sm-7">
                        @switch($contenu->type)
                            @case('video')
                                <span class="badge badge-danger">Vidéo</span>
                                @break
                            @case('document')
                                <span class="badge badge-primary">Document</span>
                                @break
                            @case('image')
                                <span class="badge badge-success">Image</span>
                                @break
                            @case('audio')
                                <span class="badge badge-warning">Audio</span>
                                @break
                            @case('quiz')
                                <span class="badge badge-info">Quiz</span>
                                @break
                            @case('exercice')
                                <span class="badge badge-secondary">Exercice</span>
                                @break
                            @case('tutoriel')
                                <span class="badge badge-purple">Tutoriel</span>
                                @break
                        @endswitch
                    </dd>
                    
                    <dt class="col-sm-5">Chapitre</dt>
                    <dd class="col-sm-7">
                        <a href="{{ route('back.formation.chapitres.show', $contenu->chapitre) }}" class="text-info">
                            {{ $contenu->chapitre->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-5">Cours</dt>
                    <dd class="col-sm-7">
                        <a href="{{ route('back.formation.cours.show', $contenu->chapitre->cour) }}" class="text-info">
                            {{ $contenu->chapitre->cour->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-5">Ordre</dt>
                    <dd class="col-sm-7">{{ $contenu->ordre + 1 }}</dd>
                    
                    <dt class="col-sm-5">Statut</dt>
                    <dd class="col-sm-7">
                        @if($contenu->is_visible)
                            <span class="badge badge-success">Visible</span>
                        @else
                            <span class="badge badge-secondary">Masqué</span>
                        @endif
                    </dd>
                    
                    @if($contenu->telechargeable)
                    <dt class="col-sm-5">Téléchargeable</dt>
                    <dd class="col-sm-7">
                        <span class="badge badge-success">Oui</span>
                    </dd>
                    @endif
                    
                    @if($contenu->fichier)
                    <dt class="col-sm-5">Type de fichier</dt>
                    <dd class="col-sm-7">
                        <span class="badge badge-info">{{ strtoupper($contenu->type_fichier) }}</span>
                    </dd>
                    
                    <dt class="col-sm-5">Taille</dt>
                    <dd class="col-sm-7">{{ $contenu->taille_formatee }}</dd>
                    @endif
                    
                    <dt class="col-sm-5">Créé le</dt>
                    <dd class="col-sm-7">{{ $contenu->created_at->format('d/m/Y H:i') }}</dd>
                    
                    <dt class="col-sm-5">Modifié le</dt>
                    <dd class="col-sm-7">{{ $contenu->updated_at->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.chapitres.show', $contenu->chapitre) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour au chapitre
                    </a>
                    <button type="button" class="btn btn-{{ $contenu->is_visible ? 'warning' : 'success' }}" 
                            onclick="toggleVisibility({{ $contenu->id }}, {{ $contenu->is_visible ? 'false' : 'true' }})">
                        <i class="fas fa-{{ $contenu->is_visible ? 'eye-slash' : 'eye' }}"></i>
                        {{ $contenu->is_visible ? 'Masquer' : 'Afficher' }}
                    </button>
                </div>
            </div>
        </div>
        
        @if($contenu->type == 'quiz' && isset($contenu->questions))
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Statistiques du quiz
                </h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Tentatives</span>
                                <span class="info-box-number">{{ $contenu->tentatives_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Note moyenne</span>
                                <span class="info-box-number">{{ round($contenu->note_moyenne ?? 0, 1) }}/20</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="progress-group">
                            <span class="progress-text">Taux de réussite</span>
                            <span class="progress-number"><b>{{ round($contenu->taux_reussite ?? 0, 1) }}%</b></span>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: {{ $contenu->taux_reussite ?? 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
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
</script>
@endpush