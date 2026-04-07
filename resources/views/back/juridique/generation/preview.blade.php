@extends('back.juridique.layouts.app')
@section('title', 'Aperçu')
@section('juridique-content')
<div class="card"><div class="card-header">Aperçu du document</div><div class="card-body">{!! $apercu !!}</div><div class="card-footer"><a href="{{ route('back.juridique.generation.create', ['modele_id' => $modele->id]) }}" class="btn btn-secondary">Retour</a></div></div>
@endsection