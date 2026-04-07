@extends('back.juridique.layouts.app')
@section('title', 'Litiges')
@section('page_title', 'Gestion des litiges')
@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-gavel mr-2"></i> Litiges</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.litiges.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouveau litige</a></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Référence</th><th>Titre</th><th>Type</th><th>Statut</th><th>Date ouverture</th><th>Montant</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($litiges as $l)
                <tr><td><code>{{ $l->reference }}</code></td><td>{{ $l->titre }}</td><td>@include('back.juridique.partials.status-badge', ['status' => $l->type])</td><td>@include('back.juridique.partials.status-badge', ['status' => $l->statut])</td><td>{{ $l->date_ouverture->format('d/m/Y') }}</td><td>{{ $l->montant_en_jeu ? number_format($l->montant_en_jeu, 2) . ' €' : '-' }}</td><td><a href="{{ route('back.juridique.litiges.show', $l) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a><a href="{{ route('back.juridique.litiges.edit', $l) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td></tr>
                @empty <tr><td colspan="7" class="text-center">Aucun litige</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $litiges])</div>
</div>
@endsection