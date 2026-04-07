@extends('back.juridique.layouts.app')
@section('title', 'Nouvelle évaluation')
@section('page_title', 'Créer une évaluation de conformité')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-plus-circle"></i> Informations</h3></div>
            <form action="{{ route('back.juridique.conformites.store') }}" method="POST">
                @csrf
                <div class="card-body">@include('back.juridique.conformites.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="{{ route('back.juridique.conformites.index') }}" class="btn btn-secondary">Annuler</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Informations</div>
            <div class="card-body">
                <p>Une évaluation de conformité permet de vérifier qu'une entreprise respecte les textes légaux.</p>
                <div class="alert alert-info">Le score est calculé automatiquement en fonction des critères évalués.</div>
            </div>
        </div>
    </div>
</div>
@endsection