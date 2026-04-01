@extends('back.formation.layouts.app')

@section('title', 'Modifier le contenu')
@section('page_title', 'Modification du contenu')
@section('page_subtitle', 'Modifier les informations du contenu : ' . $contenu->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Informations du contenu
                </h3>
            </div>
            <form action="{{ route('back.formation.contenus.update', $contenu) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.contenus.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.contenus.show', $contenu) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir le contenu
                    </a>
                    <a href="{{ route('back.formation.contenus.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Statistiques
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-7">Type</dt>
                    <dd class="col-sm-5">
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
                    
                    <dt class="col-sm-7">Chapitre</dt>
                    <dd class="col-sm-5">
                        <a href="{{ route('back.formation.chapitres.show', $contenu->chapitre) }}" class="text-info">
                            {{ Str::limit($contenu->chapitre->titre, 20) }}
                        </a>
                    </dd>
                    
                    @if($contenu->fichier)
                    <dt class="col-sm-7">Fichier</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-success">{{ strtoupper($contenu->type_fichier) }}</span>
                        <br>
                        <small>{{ $contenu->taille_formatee }}</small>
                    </dd>
                    @endif
                    
                    <dt class="col-sm-7">Créé le</dt>
                    <dd class="col-sm-5">{{ $contenu->created_at->format('d/m/Y') }}</dd>
                    
                    <dt class="col-sm-7">Dernière modification</dt>
                    <dd class="col-sm-5">{{ $contenu->updated_at->format('d/m/Y') }}</dd>
                </dl>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Zone de danger
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    La suppression d'un contenu est irréversible.
                    @if($contenu->fichier)
                        Le fichier associé sera également supprimé.
                    @endif
                </p>
                <form action="{{ route('back.formation.contenus.destroy', $contenu) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Supprimer le contenu
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection