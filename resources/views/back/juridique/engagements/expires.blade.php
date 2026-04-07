@extends('back.juridique.layouts.app')
@section('title', 'Engagements expirés')
@section('page_title', 'Engagements arrivés à expiration')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-exclamation-triangle text-danger"></i> Engagements expirés</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Référence</th><th>Titre</th><th>Type</th><th>Date expiration</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($engagements as $e)
                <td><td><code>{{ $e->reference }}</code></td><td>{{ $e->document->titre }}</td><td>@include('back.juridique.partials.status-badge', ['status' => $e->type_engagement])</td><td class="text-danger">{{ $e->date_fin->format('d/m/Y') }}</td><td><a href="{{ route('back.juridique.engagements.show', $e) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                @empty <td><td colspan="5" class="text-center">Aucun engagement expiré</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection