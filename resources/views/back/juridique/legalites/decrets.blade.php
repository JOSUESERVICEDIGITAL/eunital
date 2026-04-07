@extends('back.juridique.layouts.app')
@section('title', 'Décrets')
@section('page_title', 'Décrets et arrêtés')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title">Décrets</h3></div><div class="card-body p-0"><table class="table"><thead><tr><th>Titre</th><th>Référence</th><th>Date publication</th><th>Actions</th></tr></thead><tbody>@forelse($legalites as $l)<tr><td>{{ $l->titre }}</td><td><code>{{ $l->reference }}</code></td><td>{{ $l->date_publication->format('d/m/Y') }}</td><td><a href="{{ route('back.juridique.legalites.show', $l) }}" class="btn btn-sm btn-info">Voir</a></td></tr>@empty<tr><td colspan="4">Aucun décret</td></tr>@endforelse</tbody></table></div></div>
@endsection