@extends('back.juridique.layouts.app')
@section('title', 'Contrats actifs')
@section('page_title', 'Contrats actifs')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Contrats en cours de validité</h3></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Référence</th><th>Titre</th><th>Type</th><th>Date fin</th><th>Montant</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($contrats as $c)
                    <tr><td><code>{{ $c->reference }}</code></td><td>{{ $c->document->titre }}</td><td>@include('back.juridique.partials.status-badge', ['status' => $c->type_contrat])</td>
                    <td>{{ $c->date_fin ? $c->date_fin->format('d/m/Y') : 'Indéterminée' }}</td><td>{{ $c->montant ? number_format($c->montant, 2) . ' ' . $c->devise : '-' }}</td>
                    <td><a href="{{ route('back.juridique.contrats.show', $c) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                    @empty <td><td colspan="6" class="text-center">Aucun contrat actif</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection