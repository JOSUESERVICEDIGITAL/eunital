@extends('back.juridique.layouts.app')
@section('title', 'Litiges ouverts')
@section('page_title', 'Litiges en cours')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-exclamation-circle text-warning"></i> Litiges ouverts</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Référence</th><th>Titre</th><th>Type</th><th>Date ouverture</th><th>Montant</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($litiges as $l)
                <tr><td><code>{{ $l->reference }}</code></td><td>{{ $l->titre }}</td><td>@include('back.juridique.partials.status-badge', ['status' => $l->type])</td><td>{{ $l->date_ouverture->format('d/m/Y') }}</td><td class="text-danger">{{ number_format($l->montant_en_jeu ?? 0, 2) }} €</td><td><a href="{{ route('back.juridique.litiges.show', $l) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                @empty <tr><td colspan="6" class="text-center">Aucun litige ouvert</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection