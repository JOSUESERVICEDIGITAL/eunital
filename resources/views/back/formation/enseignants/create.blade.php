@extends('back.formation.layouts.app')

@section('title', 'Ajouter un enseignant')
@section('page_title', 'Nouvel enseignant')
@section('page_subtitle', 'Ajouter un formateur à la plateforme')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations de l'enseignant
                </h3>
            </div>
            <form action="{{ route('back.formation.enseignants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('back.formation.enseignants.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.enseignants.index') }}" class="btn btn-secondary">
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
                <p>Un enseignant peut être associé à plusieurs cours.</p>
                <ul class="text-muted">
                    <li>Choisissez un utilisateur existant</li>
                    <li>Ajoutez ses compétences et spécialités</li>
                    <li>Définissez son expérience</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection