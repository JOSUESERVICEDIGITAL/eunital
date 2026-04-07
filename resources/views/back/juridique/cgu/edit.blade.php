@extends('back.juridique.layouts.app')
@section('title', 'Modifier version')
@section('page_title', 'Modification')
@section('juridique-content')
<div class="row"><div class="col-md-8"><div class="card"><div class="card-header">Modifier</div><form action="{{ route('back.juridique.cgu.update', $cguCgv) }}" method="POST">@csrf @method('PUT')<div class="card-body">@include('back.juridique.cgu.form')</div><div class="card-footer"><button type="submit" class="btn btn-primary">Mettre à jour</button><a href="{{ route('back.juridique.cgu.show', $cguCgv) }}" class="btn btn-info">Voir</a><a href="{{ route('back.juridique.cgu.index') }}" class="btn btn-secondary">Retour</a></div></form></div></div><div class="col-md-4"><div class="card"><div class="card-header">Versions</div><div class="card-body"><p>Version actuelle: v{{ $cguCgv->version }}</p></div></div></div></div>
@endsection