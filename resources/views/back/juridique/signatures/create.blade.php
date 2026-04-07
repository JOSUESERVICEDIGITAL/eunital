@extends('back.juridique.layouts.app')
@section('title', 'Nouvelle signature')
@section('page_title', 'Ajouter une signature')
@section('page_subtitle', 'Demander une signature électronique')

@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-plus-circle"></i> Informations</h3></div>
            <form action="{{ route('back.juridique.signatures.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.juridique.signatures.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                    <a href="{{ route('back.juridique.signatures.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Annuler</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-header"><h3 class="card-title">Informations</h3></div><div class="card-body">
            <p>Une signature peut être demandée à :</p><ul><li>Un utilisateur interne</li><li>Un client externe (par email)</li></ul>
            <div class="alert alert-info">Les signatures sont tracées avec horodatage et adresse IP.</div>
        </div></div>
    </div>
</div>
@endsection
