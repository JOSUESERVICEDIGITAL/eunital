@extends('back.juridique.layouts.app')
@section('title', 'Guides pratiques')
@section('page_title', 'Guides juridiques')
@section('juridique-content')
<div class="row">@forelse($guides as $guide)<div class="col-md-4 mb-3"><div class="card h-100"><div class="card-body"><h5 class="card-title">{{ $guide->titre }}</h5><p class="card-text">{{ Str::limit($guide->contenu, 100) }}</p><a href="{{ route('back.juridique.conseils.show', $guide) }}" class="btn btn-primary">Lire</a></div><div class="card-footer text-muted">{{ $guide->vues }} vues</div></div></div>@empty<div class="col-12 text-center">Aucun guide disponible</div>@endforelse</div>
@endsection