@extends('back.juridique.layouts.app')
@section('title', 'Nouveau litige')
@section('page_title', 'Créer un litige')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-plus-circle"></i> Informations</h3></div>
            <form action="{{ route('back.juridique.litiges.store') }}" method="POST">
                @csrf
                <div class="card-body">@include('back.juridique.litiges.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="{{ route('back.juridique.litiges.index') }}" class="btn btn-secondary">Annuler</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header">Informations</div><div class="card-body"><p>Un litige peut être :</p><ul><li>Commercial</li><li>Social</li><li>Civil</li><li>Administratif</li></ul></div></div></div>
</div>
@endsection