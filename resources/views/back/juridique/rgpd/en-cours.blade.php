@extends('back.juridique.layouts.app')
@section('title', 'RGPD - En cours')
@section('page_title', 'Démarches en cours')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-clock text-warning"></i> Démarches en cours</h3></div><div class="card-body p-0"><table class="table"><thead><tr><th>Titre</th><th>Type</th><th>Date limite</th><th>Actions</th></tr></thead><tbody>@forelse($demarches as $d)<tr><td>{{ $d->titre }}</td><td>{{ $d->type_label }}</td><td class="text-{{ $d->date_limite && $d->date_limite < now() ? 'danger' : 'warning' }}">{{ $d->date_limite ? $d->date_limite->format('d/m/Y') : '-' }}</td><td><a href="{{ route('back.juridique.rgpd.show', $d) }}" class="btn btn-sm btn-info">Voir</a><button onclick="valider({{ $d->id }})" class="btn btn-sm btn-success">Valider</button></td></tr>@empty <td><td colspan="4">Aucune démarche en cours</td></tr>@endforelse</tbody></table></div></div>
@endsection