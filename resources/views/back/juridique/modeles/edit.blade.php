@extends('back.juridique.layouts.app')

@section('title', 'Modifier le modèle')
@section('page_title', 'Modification du modèle')
@section('page_subtitle', $modeleDocument->titre)

@section('juridique-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier le modèle
                </h3>
            </div>
            <form action="{{ route('back.juridique.modeles.update', $modeleDocument) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.juridique.modeles.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button>
                    <a href="{{ route('back.juridique.modeles.show', $modeleDocument) }}" class="btn btn-info"><i class="fas fa-eye"></i> Voir</a>
                    <a href="{{ route('back.juridique.modeles.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
