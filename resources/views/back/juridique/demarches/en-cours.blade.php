@extends('back.juridique.layouts.app')
@section('title', 'Démarches en cours')
@section('page_title', 'Démarches actives')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-play-circle text-success"></i> Démarches actives</h3></div><div class="card-body p-0"><table class="table"><thead><tr><th>Titre</th><th>Catégorie</th><th>Délai</th><th>Actions</th></tr></thead><tbody>@forelse($demarches as $d)<tr><td><strong>{{ $d->titre }}</strong></td><td>{{ $d->categorie_label }}</td><td>{{ $d->delai_formate }}</td><td><a href="{{ route('back.juridique.demarches.show', $d) }}" class="btn btn-sm btn-info">Voir</a></td></tr>@empty <td><td colspan="4">Aucune démarche active</td></tr>@endforelse</tbody></table></div></div>
@endsection