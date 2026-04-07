@extends('back.juridique.layouts.app')
@section('title', 'Textes en vigueur')
@section('page_title', 'Législation applicable')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title">Textes en vigueur</h3></div><div class="card-body p-0"><table class="table"><thead><tr><th>Titre</th><th>Type</th><th>Date application</th><th>Actions</th></tr></thead><tbody>@forelse($legalites as $l)<tr><td>{{ $l->titre }}</td><td>@include('back.juridique.partials.status-badge', ['status' => $l->type])</td><td>{{ $l->date_application ? $l->date_application->format('d/m/Y') : '-' }}</td><td><a href="{{ route('back.juridique.legalites.show', $l) }}" class="btn btn-sm btn-info">Voir</a></td></tr>@empty<tr><td colspan="4">Aucun texte en vigueur</td></tr>@endforelse</tbody></table></div></div>
@endsection