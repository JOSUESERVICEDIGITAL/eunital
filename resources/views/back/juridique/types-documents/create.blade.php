@extends('back.juridique.layouts.app')

@section('title', 'Créer un type de document')
@section('page_title', 'Nouveau type de document')
@section('page_subtitle', 'Ajouter une catégorie de document juridique')

@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations du type
                </h3>
            </div>
            <form action="{{ route('back.juridique.types-documents.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.juridique.types-documents.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.juridique.types-documents.index') }}" class="btn btn-secondary">
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
                <p class="text-muted">Les types de documents permettent de catégoriser les documents juridiques.</p>
                <ul>
                    <li>Le code est utilisé pour générer les numéros de documents</li>
                    <li>La durée de validité détermine l'expiration automatique</li>
                    <li>La signature électronique peut être obligatoire ou optionnelle</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
