@extends('back.formation.layouts.app')

@section('title', 'Créer un chapitre')
@section('page_title', 'Nouveau chapitre')
@section('page_subtitle', 'Ajouter un chapitre à un cours existant')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations du chapitre
                </h3>
            </div>
            <form action="{{ route('back.formation.chapitres.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.formation.chapitres.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.chapitres.index') }}" class="btn btn-secondary">
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
                        <li>Structurez logiquement vos chapitres</li>
                        <li>Utilisez des titres clairs et explicites</li>
                        <li>Estimez la durée pour aider les apprenants</li>
                        <li>Les chapitres gratuits attirent plus d'apprenants</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h6>Ordre des chapitres :</h6>
                    <p class="text-muted small">
                        L'ordre détermine la position du chapitre dans le cours.
                        Si vous laissez vide, le chapitre sera ajouté à la fin.
                    </p>
                </div>
                
                <div class="mt-3">
                    <h6>Contenus possibles :</h6>
                    <ul class="text-muted small">
                        <li><i class="fas fa-video"></i> Vidéos</li>
                        <li><i class="fas fa-file-alt"></i> Documents PDF</li>
                        <li><i class="fas fa-image"></i> Images</li>
                        <li><i class="fas fa-headphones"></i> Audios</li>
                        <li><i class="fas fa-puzzle-piece"></i> Quiz</li>
                        <li><i class="fas fa-code"></i> Exercices</li>
                        <li><i class="fas fa-chalkboard"></i> Tutoriels</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection