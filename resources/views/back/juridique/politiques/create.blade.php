@extends('back.juridique.layouts.app')
@section('title', 'Nouvelle politique')
@section('page_title', 'Créer une politique')
@section('juridique-content')
<div class="row"><div class="col-md-8"><div class="card"><div class="card-header">Informations</div><form action="{{ route('back.juridique.politiques.store') }}" method="POST">@csrf<div class="card-body">@include('back.juridique.politiques.form')</div><div class="card-footer"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="{{ route('back.juridique.politiques.index') }}" class="btn btn-secondary">Annuler</a></div></form></div></div><div class="col-md-4"><div class="card"><div class="card-header">Informations</div><div class="card-body"><p>La politique de confidentialité détaille la gestion des données personnelles.</p></div></div></div></div>
@endsection