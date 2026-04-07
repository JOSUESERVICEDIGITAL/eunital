@extends('back.juridique.layouts.app')
@section('title', 'Ajouter entreprise')
@section('page_title', 'Nouvelle entreprise')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-plus-circle"></i> Informations</h3></div>
            <form action="{{ route('back.juridique.entreprises.store') }}" method="POST">
                @csrf
                <div class="card-body">@include('back.juridique.entreprises.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="{{ route('back.juridique.entreprises.index') }}" class="btn btn-secondary">Annuler</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header">Informations</div><div class="card-body"><p>Le SIRET doit comporter 14 chiffres.</p><p>Le code APE est sur 5 caractères.</p></div></div></div>
</div>
@endsection