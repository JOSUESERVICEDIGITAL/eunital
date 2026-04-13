@extends('back.formation.layouts.app')

@section('title', 'Nouvelle salle')
@section('page_title', 'Créer une salle')
@section('page_subtitle', 'Créer la grande salle pédagogique et relier ses accès')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-door-open mr-2"></i>
                    Informations de la salle
                </h3>
            </div>

            <form action="{{ route('back.formation.salles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    @include('back.formation.salles.form')
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Enregistrer
                    </button>

                    <a href="{{ route('back.formation.salles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Conseils
                </h3>
            </div>

            <div class="card-body">
                <div class="alert alert-info">
                    Une salle peut être liée à un cours, un module et un code d’accès.
                </div>

                <ul class="text-muted pl-3">
                    <li>Utilise un titre clair</li>
                    <li>Associe un code d’accès actif</li>
                    <li>Active les widgets utiles</li>
                    <li>Ouvre la salle seulement au bon moment</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
