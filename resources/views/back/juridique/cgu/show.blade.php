@extends('back.juridique.layouts.app')
@section('title', $cguCgv->titre)
@section('page_title', $cguCgv->type_label)
@section('juridique-content')
<div class="row"><div class="col-md-4"><div class="card"><div class="card-header">Informations</div><div class="card-body"><dl><dt>Version</dt><dd>v{{ $cguCgv->version }}</dd><dt>Date d'effet</dt><dd>{{ $cguCgv->date_effet->format('d/m/Y') }}</dd><dt>Statut</dt><dd>@include('back.juridique.partials.status-badge', ['status' => $cguCgv->is_active ? 'actif' : 'inactif'])</dd></dl></div><div class="card-footer"><a href="{{ route('back.juridique.cgu.edit', $cguCgv) }}" class="btn btn-warning">Modifier</a><a href="{{ route('back.juridique.cgu.index') }}" class="btn btn-secondary">Retour</a></div></div></div><div class="col-md-8"><div class="card"><div class="card-header">Contenu</div><div class="card-body">{!! nl2br(e($cguCgv->contenu)) !!}</div></div></div></div>
@endsection