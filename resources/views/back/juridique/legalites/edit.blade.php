@extends('back.juridique.layouts.app')
@section('title', 'Modifier texte')
@section('page_title', 'Modification')
@section('juridique-content')
<div class="row"><div class="col-md-8"><div class="card"><div class="card-header">Modifier</div><form action="{{ route('back.juridique.legalites.update', $legalite) }}" method="POST">@csrf @method('PUT')<div class="card-body">@include('back.juridique.legalites.form')</div><div class="card-footer"><button type="submit" class="btn btn-primary">Mettre à jour</button><a href="{{ route('back.juridique.legalites.show', $legalite) }}" class="btn btn-info">Voir</a><a href="{{ route('back.juridique.legalites.index') }}" class="btn btn-secondary">Retour</a></div></form></div></div><div class="col-md-4"><div class="card"><div class="card-header">Statistiques</div><div class="card-body"><dl><dt>Évaluations liées</dt><dd>{{ $legalite->conformites_count ?? 0 }}</dd></dl></div></div></div></div>
@endsection