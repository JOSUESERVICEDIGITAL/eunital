@extends('back.formation.layouts.app')

@section('title', 'Modifier la catégorie')
@section('page_title', 'Modification de catégorie')
@section('page_subtitle', 'Modifier les informations de la catégorie : ' . $categorieModule->nom)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Informations de la catégorie
                </h3>
            </div>
            <form action="{{ route('back.formation.categories-modules.update', $categorieModule) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.categories.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.categories-modules.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
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
                    <dt class="col-sm-6">Modules associés</dt>
                    <dd class="col-sm-6">
                        <span class="badge badge-info badge-lg">{{ $categorieModule->modules_count ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-6">Créé le</dt>
                    <dd class="col-sm-6">{{ $categorieModule->created_at->format('d/m/Y H:i') }}</dd>
                    
                    <dt class="col-sm-6">Dernière modification</dt>
                    <dd class="col-sm-6">{{ $categorieModule->updated_at->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection