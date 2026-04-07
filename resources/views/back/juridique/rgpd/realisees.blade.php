@extends('back.juridique.layouts.app')
@section('title', 'RGPD - Réalisées')
@section('page_title', 'Démarches réalisées')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Démarches réalisées</h3></div><div class="card-body p-0"><table class="table"><thead><tr><th>Titre</th><th>Type</th><th>Date réalisation</th><th>Actions</th></tr></thead><tbody>@forelse($demarches as $d)</td><td>{{ $d->titre }}</td><td>{{ $d->type_label }}</td><td>{{ $d->date_realisation->format('d/m/Y') }}</td><td><a href="{{ route('back.juridique.rgpd.show', $d) }}" class="btn btn-sm btn-info">Voir</a></td></tr>@empty <td><td colspan="4">Aucune démarche réalisée</td></tr>@endforelse</tbody></table></div></div>
@endsection