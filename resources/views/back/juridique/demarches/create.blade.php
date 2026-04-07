@extends('back.juridique.layouts.app')
@section('title', 'Nouvelle démarche')
@section('page_title', 'Créer une démarche administrative')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-plus-circle"></i> Informations</h3></div>
            <form action="{{ route('back.juridique.demarches.store') }}" method="POST">
                @csrf
                <div class="card-body">@include('back.juridique.demarches.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="{{ route('back.juridique.demarches.index') }}" class="btn btn-secondary">Annuler</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-header">Informations</div><div class="card-body"><p>Les démarches administratives sont des procédures à suivre pour diverses formalités.</p><div class="alert alert-info">Les démarches actives sont affichées dans le catalogue public.</div></div></div>
    </div>
</div>
@endsection