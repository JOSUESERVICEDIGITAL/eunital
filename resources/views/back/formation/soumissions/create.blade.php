@extends('back.formation.layouts.app')

@section('title', 'Nouvelle soumission')
@section('page_title', 'Soumettre un devoir')
@section('page_subtitle', 'Déposer votre travail pour correction')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-upload mr-2"></i>
                    Soumettre un devoir
                </h3>
            </div>
            <form action="{{ route('back.formation.soumissions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('back.formation.soumissions.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Soumettre
                    </button>
                    <a href="{{ route('back.formation.soumissions.index') }}" class="btn btn-secondary">
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
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb"></i>
                    <strong>Règles de soumission :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Un seul dépôt par devoir</li>
                        <li>Respectez la date limite</li>
                        <li>Formats acceptés : PDF, DOC, DOCX, ZIP, etc.</li>
                        <li>Taille maximale : 20 Mo par fichier</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h6>Conseils :</h6>
                    <ul class="text-muted small">
                        <li>Vérifiez votre fichier avant envoi</li>
                        <li>Nommez clairement vos fichiers</li>
                        <li>Ajoutez un commentaire si nécessaire</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection