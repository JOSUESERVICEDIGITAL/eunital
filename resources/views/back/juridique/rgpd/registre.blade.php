@extends('back.juridique.layouts.app')
@section('title', 'Registre RGPD')
@section('page_title', 'Registre des traitements')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title">Registre des traitements de données</h3></div><div class="card-body p-0"><div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Titre</th><th>Données concernées</th><th>Responsable</th><th>Sous-traitants</th><th>Sécurité</th><th>Date</th></thead><tbody>@forelse($registres as $r)<tr><td>{{ $r->titre }}</td><td>{{ implode(', ', $r->donnees_concernees ?? []) }}</td><td>{{ implode(', ', $r->responsables ?? []) }}</td><td>{{ count($r->sous_traitants ?? []) }}</td><td>{{ count($r->mesures_securite ?? []) }}</td><td>{{ $r->date_realisation->format('d/m/Y') }}</td></tr>@empty <td><td colspan="6">Aucun registre</td></tr>@endforelse</tbody>}</div></div></div>
@endsection