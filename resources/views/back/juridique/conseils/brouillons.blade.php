@extends('back.juridique.layouts.app')
@section('title', 'Conseils brouillons')
@section('page_title', 'Articles en rédaction')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-pencil-alt text-warning"></i> Brouillons</h3></div><div class="card-body p-0"><table class="table"><thead><tr><th>Titre</th><th>Catégorie</th><th>Date</th><th>Actions</th></tr></thead><tbody>@forelse($conseils as $c)<tr><td><strong>{{ $c->titre }}</strong></td><td>{{ $c->categorie_label }}</td><td>{{ $c->created_at->format('d/m/Y') }}</td><td><a href="{{ route('back.juridique.conseils.edit', $c) }}" class="btn btn-sm btn-warning">Continuer</a><button onclick="publier({{ $c->id }})" class="btn btn-sm btn-success">Publier</button></td></tr>@empty<tr><td colspan="4">Aucun brouillon</td></tr>@endforelse</tbody></table></div></div>
@endsection