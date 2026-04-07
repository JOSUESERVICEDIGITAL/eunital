@extends('back.juridique.layouts.app')
@section('title', 'Mentions actives')
@section('page_title', 'Mentions légales en vigueur')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Mentions actives</h3></div><div class="card-body p-0"><table class="table"><thead><tr><th>Titre</th><th>Type</th><th>Version</th><th>Date effet</th><th>Actions</th></tr></thead><tbody>@forelse($mentions as $m)<tr><td>{{ $m->titre }}</td><td>{{ $m->type_label }}</td><td>v{{ $m->version }}</td><td>{{ $m->date_effet->format('d/m/Y') }}</td><td><a href="{{ route('back.juridique.mentions.show', $m) }}" class="btn btn-sm btn-info">Voir</a></td></tr>@empty <td><td colspan="5">Aucune mention active</td></tr>@endforelse</tbody></table></div></div>
@endsection