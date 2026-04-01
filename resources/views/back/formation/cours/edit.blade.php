@extends('back.formation.layouts.app')

@section('title', 'Modifier le cours')
@section('page_title', 'Modification du cours')
@section('page_subtitle', 'Modifier les informations du cours : ' . $cour->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Informations du cours
                </h3>
            </div>
            <form action="{{ route('back.formation.cours.update', $cour) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.cours.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.cours.show', $cour) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir le cours
                    </a>
                    <a href="{{ route('back.formation.cours.index') }}" class="btn btn-secondary">
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
                    <dt class="col-sm-7">Nombre de chapitres</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-primary">{{ $cour->chapitres_count ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">Nombre d'étudiants</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-success">{{ $cour->utilisateurs_count ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">Progression moyenne</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-warning">{{ round($cour->progression_moyenne ?? 0, 1) }}%</span>
                    </dd>
                    
                    <dt class="col-sm-7">Taux de complétion</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-info">{{ round($cour->taux_completion ?? 0, 1) }}%</span>
                    </dd>
                    
                    <dt class="col-sm-7">Créé le</dt>
                    <dd class="col-sm-5">{{ $cour->created_at->format('d/m/Y') }}</dd>
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
                    La suppression d'un cours entraînera la suppression de tous les chapitres, contenus et devoirs associés.
                </p>
                <form action="{{ route('back.formation.cours.destroy', $cour) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Supprimer le cours
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection