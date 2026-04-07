@extends('back.juridique.layouts.app')
@section('title', 'Contrats')
@section('page_title', 'Gestion des contrats')
@section('page_subtitle', 'Liste de tous les contrats')

@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-handshake mr-2"></i> Contrats</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.contrats.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouveau contrat</a></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Référence</th><th>Titre</th><th>Type</th><th>Parties</th><th>Période</th><th>Montant</th><th>Statut</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($contrats as $c)
                    <tr>
                        <td><code>{{ $c->reference }}</code></td>
                        <td><strong>{{ $c->document->titre }}</strong></td>
                        <td>@include('back.juridique.partials.status-badge', ['status' => $c->type_contrat])</td>
                        <td>{{ count($c->document->entreprises) }} entreprise(s) + {{ count($c->document->utilisateurs) }} personne(s)</td>
                        <td>{{ $c->date_debut->format('d/m/Y') }}<br>→ {{ $c->date_fin ? $c->date_fin->format('d/m/Y') : 'Indéterminée' }}</td>
                        <td>{{ $c->montant ? number_format($c->montant, 2) . ' ' . $c->devise : '-' }}</td>
                        <td>{{ $c->date_fin && $c->date_fin < now() ? 'Expiré' : ($c->date_fin && $c->date_fin <= now()->addDays(30) ? 'Expire bientôt' : 'Actif') }}</td>
                        <td><a href="{{ route('back.juridique.contrats.show', $c) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('back.juridique.contrats.pdf', $c) }}" class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-file-pdf"></i></a></td>
                    </tr>
                    @empty <td><td colspan="8" class="text-center">Aucun contrat</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $contrats])</div>
</div>
@endsection