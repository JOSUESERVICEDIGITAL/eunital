@extends('back.formation.layouts.app')

@section('title', 'Modifier le module')
@section('page_title', 'Modification du module')
@section('page_subtitle', 'Modifier les informations du module : ' . $module->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Informations du module
                </h3>
            </div>
            <form action="{{ route('back.formation.modules.update', $module) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.modules.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.modules.show', $module) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir le module
                    </a>
                    <a href="{{ route('back.formation.modules.index') }}" class="btn btn-secondary">
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
                    <dt class="col-sm-7">Nombre de cours</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-primary badge-lg">{{ $module->cours_count ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">Nombre d'inscrits</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-success badge-lg">{{ $module->inscriptions_count ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">Durée totale estimée</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-info">{{ floor(($module->duree_totale ?? 0) / 60) }}h {{ ($module->duree_totale ?? 0) % 60 }}min</span>
                    </dd>
                    
                    <dt class="col-sm-7">Progression moyenne</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-warning">{{ round($module->progression_moyenne ?? 0, 1) }}%</span>
                    </dd>
                    
                    <dt class="col-sm-7">Créé le</dt>
                    <dd class="col-sm-5">{{ $module->created_at->format('d/m/Y') }}</dd>
                    
                    <dt class="col-sm-7">Dernière modification</dt>
                    <dd class="col-sm-5">{{ $module->updated_at->format('d/m/Y') }}</dd>
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
                    La suppression d'un module entraînera la suppression de tous les cours, chapitres et contenus associés.
                </p>
                <form action="{{ route('back.formation.modules.destroy', $module) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Supprimer le module
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection