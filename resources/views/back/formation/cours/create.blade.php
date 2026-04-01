@extends('back.formation.layouts.app')

@section('title', 'Créer un cours')
@section('page_title', 'Nouveau cours de formation')
@section('page_subtitle', 'Ajouter un cours avec ses informations générales')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations du cours
                </h3>
            </div>
            <form action="{{ route('back.formation.cours.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('back.formation.cours.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.cours.index') }}" class="btn btn-secondary">
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
                    Conseils
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb"></i>
                    <strong>Bonnes pratiques :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Structurez le cours en chapitres logiques</li>
                        <li>Ajoutez des objectifs clairs</li>
                        <li>Précisez les prérequis nécessaires</li>
                        <li>Utilisez une image de couverture attractive</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h6>Structure recommandée :</h6>
                    <ul class="text-muted">
                        <li><i class="fas fa-list-ol"></i> Introduction</li>
                        <li><i class="fas fa-layer-group"></i> Chapitres principaux</li>
                        <li><i class="fas fa-check-circle"></i> Exercices pratiques</li>
                        <li><i class="fas fa-tasks"></i> Évaluations</li>
                        <li><i class="fas fa-star"></i> Conclusion</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection