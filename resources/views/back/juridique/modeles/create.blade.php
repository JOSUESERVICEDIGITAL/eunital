@extends('back.juridique.layouts.app')

@section('title', 'Créer un modèle')
@section('page_title', 'Nouveau modèle de document')
@section('page_subtitle', 'Créer un modèle réutilisable pour la génération de documents')

@section('juridique-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations du modèle
                </h3>
            </div>
            <form action="{{ route('back.juridique.modeles.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.juridique.modeles.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                    <a href="{{ route('back.juridique.modeles.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
