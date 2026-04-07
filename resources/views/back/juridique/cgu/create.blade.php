@extends('back.juridique.layouts.app')
@section('title', 'Nouvelle version')
@section('page_title', 'Créer une version')
@section('juridique-content')
<div class="row"><div class="col-md-8"><div class="card"><div class="card-header">Informations</div><form action="{{ route('back.juridique.cgu.store') }}" method="POST">@csrf<div class="card-body">@include('back.juridique.cgu.form')</div><div class="card-footer"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="{{ route('back.juridique.cgu.index') }}" class="btn btn-secondary">Annuler</a></div></form></div></div><div class="col-md-4"><div class="card"><div class="card-header">Informations</div><div class="card-body"><p>Les CGU/CGV sont consultables par les utilisateurs.</p></div></div></div></div>
@endsection