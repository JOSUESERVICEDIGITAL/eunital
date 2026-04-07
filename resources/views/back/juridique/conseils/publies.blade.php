@extends('back.juridique.layouts.app')
@section('title', 'Conseils publiés')
@section('page_title', 'Articles publiés')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Conseils publiés</h3></div><div class="card-body p-0"><table class="table"><thead><tr><th>Titre</th><th>Catégorie</th><th>Vues</th><th>Date</th><th>Actions</th></tr></thead><tbody>@forelse($conseils as $c)<tr><td><strong>{{ $c->titre }}</strong></td><td>{{ $c->categorie_label }}</td><td>{{ $c->vues }}</td><td>{{ $c->created_at->format('d/m/Y') }}</td><td><a href="{{ route('back.juridique.conseils.show', $c) }}" class="btn btn-sm btn-info">Voir</a></td></tr>@empty<tr><td colspan="5">Aucun conseil publié</td></tr>@endforelse</tbody></table></div></div>
@endsection