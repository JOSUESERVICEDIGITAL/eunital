@extends('back.juridique.layouts.app')
@section('title', 'Créer un contrat')
@section('page_title', 'Nouveau contrat')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-plus-circle"></i> Informations du contrat</h3></div>
            <form action="{{ route('back.juridique.contrats.store') }}" method="POST">
                @csrf
                <div class="card-body">@include('back.juridique.contrats.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button><a href="{{ route('back.juridique.contrats.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Annuler</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header"><h3 class="card-title">Informations</h3></div><div class="card-body"><p>Un contrat doit être lié à un document existant.</p><div class="alert alert-info">Le contrat sera automatiquement lié au document.</div></div></div></div>
</div>
@endsection