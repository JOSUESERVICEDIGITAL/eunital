@extends('back.formation.layouts.app')

@section('title', 'Modifier le chapitre')
@section('page_title', 'Modification du chapitre')
@section('page_subtitle', 'Modifier les informations du chapitre : ' . $chapitre->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Informations du chapitre
                </h3>
            </div>
            <form action="{{ route('back.formation.chapitres.update', $chapitre) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.chapitres.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.chapitres.show', $chapitre) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir le chapitre
                    </a>
                    <a href="{{ route('back.formation.chapitres.index') }}" class="btn btn-secondary">
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
                    <dt class="col-sm-7">Nombre de contenus</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-info">{{ $chapitre->contenus_count ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">Cours associé</dt>
                    <dd class="col-sm-5">
                        <a href="{{ route('back.formation.cours.show', $chapitre->cour) }}" class="text-info">
                            {{ $chapitre->cour->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-7">Position</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-secondary">Chapitre {{ $chapitre->ordre + 1 }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">Créé le</dt>
                    <dd class="col-sm-5">{{ $chapitre->created_at->format('d/m/Y') }}</dd>
                    
                    <dt class="col-sm-7">Dernière modification</dt>
                    <dd class="col-sm-5">{{ $chapitre->updated_at->format('d/m/Y') }}</dd>
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
                    La suppression d'un chapitre entraînera la suppression de tous les contenus associés.
                </p>
                <form action="{{ route('back.formation.chapitres.destroy', $chapitre) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Supprimer le chapitre
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection