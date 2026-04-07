@extends('back.juridique.layouts.app')
@section('title', 'Textes légaux')
@section('page_title', 'Bibliothèque juridique')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-gavel mr-2"></i> Textes légaux</h3><div class="card-tools"><a href="{{ route('back.juridique.legalites.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Ajouter</a></div></div>
    <div class="card-body p-0"><table class="table table-striped"><thead><tr><th>Titre</th><th>Type</th><th>Référence</th><th>Date publication</th><th>En vigueur</th><th>Actions</th></tr></thead><tbody>@forelse($legalites as $l)<tr><td><strong>{{ $l->titre }}</strong></td><td>@include('back.juridique.partials.status-badge', ['status' => $l->type])</td><td><code>{{ $l->reference }}</code></td><td>{{ $l->date_publication ? $l->date_publication->format('d/m/Y') : '-' }}</td><td>@include('back.juridique.partials.status-badge', ['status' => $l->est_en_vigueur ? 'actif' : 'inactif'])</td><td><a href="{{ route('back.juridique.legalites.show', $l) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a><a href="{{ route('back.juridique.legalites.edit', $l) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td></tr>@empty<tr><td colspan="6">Aucun texte légal</td></tr>@endforelse</tbody></table></div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $legalites])</div>
</div>
@endsection