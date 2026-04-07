@extends('back.juridique.layouts.app')
@section('title', 'Ajouter texte légal')
@section('page_title', 'Nouveau texte')
@section('juridique-content')
<div class="row"><div class="col-md-8"><div class="card"><div class="card-header">Informations</div><form action="{{ route('back.juridique.legalites.store') }}" method="POST">@csrf<div class="card-body">@include('back.juridique.legalites.form')</div><div class="card-footer"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="{{ route('back.juridique.legalites.index') }}" class="btn btn-secondary">Annuler</a></div></form></div></div><div class="col-md-4"><div class="card"><div class="card-header">Informations</div><div class="card-body"><p>Les textes légaux sont utilisés pour les évaluations de conformité.</p></div></div></div></div>
@endsection