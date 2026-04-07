@extends('back.juridique.layouts.app')
@section('title', 'Modifier démarche')
@section('page_title', 'Modification')
@section('juridique-content')
<div class="row"><div class="col-md-8"><div class="card"><div class="card-header">Modifier</div><form action="{{ route('back.juridique.rgpd.update', $demarcheRgpd) }}" method="POST">@csrf @method('PUT')<div class="card-body">@include('back.juridique.rgpd.form')</div><div class="card-footer"><button type="submit" class="btn btn-primary">Mettre à jour</button><a href="{{ route('back.juridique.rgpd.show', $demarcheRgpd) }}" class="btn btn-info">Voir</a><a href="{{ route('back.juridique.rgpd.index') }}" class="btn btn-secondary">Retour</a></div></form></div></div><div class="col-md-4"><div class="card"><div class="card-header">Statut</div><div class="card-body"><p>Statut actuel: @include('back.juridique.partials.status-badge', ['status' => $demarcheRgpd->statut])</p></div></div></div></div>
@endsection