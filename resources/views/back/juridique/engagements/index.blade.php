@extends('back.juridique.layouts.app')

@section('title', 'Engagements')
@section('page_title', 'Gestion des engagements')
@section('page_subtitle', 'Chartes, codes de conduite et engagements')

@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-handshake mr-2"></i> Engagements</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.engagements.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouvel engagement</a></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Référence</th><th>Titre</th><th>Type</th><th>Date adhésion</th><th>Date fin</th><th>Statut</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($engagements as $e)
                    <tr>
                        <td><code>{{ $e->reference }}</code></td>
                        <td><strong>{{ $e->document->titre }}</strong></td>
                        <td>@include('back.juridique.partials.status-badge', ['status' => $e->type_engagement])</td>
                        <td>{{ $e->date_adhesion->format('d/m/Y') }}</td>
                        <td>{{ $e->date_fin ? $e->date_fin->format('d/m/Y') : 'Indéterminée' }}</td>
                        <td>{{ $e->date_fin && $e->date_fin < now() ? 'Expiré' : 'Actif' }}</td>
                        <td><a href="{{ route('back.juridique.engagements.show', $e) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('back.juridique.engagements.pdf', $e) }}" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i></a></td>
                    </tr>
                    @empty <td><td colspan="7" class="text-center">Aucun engagement</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $engagements])</div>
</div>
@endsection