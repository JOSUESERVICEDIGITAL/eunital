@extends('back.juridique.layouts.app')

@section('title', 'Créer un document')
@section('page_title', 'Nouveau document')
@section('page_subtitle', 'Créer un document juridique')

@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i> Informations du document</h3></div>
            <form action="{{ route('back.juridique.documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('back.juridique.documents.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                    <a href="{{ route('back.juridique.documents.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Annuler</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle"></i> Informations</h3></div>
            <div class="card-body">
                <p>Un document peut être :</p>
                <ul>
                    <li>Créé manuellement avec un modèle</li>
                    <li>Importé depuis un fichier</li>
                    <li>Généré automatiquement depuis une autre chambre</li>
                </ul>
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb"></i> Les documents peuvent nécessiter des signatures électroniques selon leur type.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
