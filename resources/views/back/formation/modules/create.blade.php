@extends('back.formation.layouts.app')

@section('title', 'Créer un module')
@section('page_title', 'Nouveau module de formation')
@section('page_subtitle', 'Ajouter un module avec ses informations générales')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations du module
                </h3>
            </div>
            <form action="{{ route('back.formation.modules.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('back.formation.modules.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.modules.index') }}" class="btn btn-secondary">
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
                        <li>Choisissez un titre clair et concis</li>
                        <li>Décrivez précisément le contenu du module</li>
                        <li>Sélectionnez le niveau approprié</li>
                        <li>Ajoutez une image de couverture attrayante</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h6>Structure d'un module :</h6>
                    <ul class="text-muted">
                        <li><i class="fas fa-book"></i> Cours</li>
                        <li><i class="fas fa-layer-group"></i> Chapitres</li>
                        <li><i class="fas fa-file-alt"></i> Contenus pédagogiques</li>
                        <li><i class="fas fa-tasks"></i> Devoirs et évaluations</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection