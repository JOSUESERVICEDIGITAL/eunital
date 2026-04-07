@extends('back.juridique.layouts.app')
@section('title', 'Engagements actifs')
@section('page_title', 'Engagements en vigueur')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Engagements actifs</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Référence</th><th>Titre</th><th>Type</th><th>Date fin</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($engagements as $e)
                <tr><td><code>{{ $e->reference }}</code></td><td>{{ $e->document->titre }}</td><td>@include('back.juridique.partials.status-badge', ['status' => $e->type_engagement])</td><td>{{ $e->date_fin ? $e->date_fin->format('d/m/Y') : 'Indéterminée' }}</td><td><a href="{{ route('back.juridique.engagements.show', $e) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                @empty <td><td colspan="5" class="text-center">Aucun engagement actif</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection