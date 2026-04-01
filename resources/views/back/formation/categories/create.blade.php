@extends('back.formation.layouts.app')

@section('title', 'Créer une catégorie')
@section('page_title', 'Nouvelle catégorie')
@section('page_subtitle', 'Ajouter une catégorie pour organiser les modules de formation')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations de la catégorie
                </h3>
            </div>
            <form action="{{ route('back.formation.categories-modules.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.formation.categories.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
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
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Les catégories permettent d'organiser les modules de formation par thème.
                </p>
                <ul class="text-muted">
                    <li>Une catégorie peut contenir plusieurs modules</li>
                    <li>L'ordre d'affichage détermine la position dans les listes</li>
                    <li>Les catégories inactives ne sont pas affichées</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection