@extends('back.juridique.layouts.app')
@section('title', 'Entreprises')
@section('page_title', 'Gestion des entreprises')
@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-building mr-2"></i> Entreprises partenaires</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.entreprises.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Ajouter</a></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Nom</th><th>SIRET</th><th>Forme juridique</th><th>Ville</th><th>Pays</th><th>Documents</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($entreprises as $e)
                <tr>
                    <td><strong>{{ $e->nom }}</strong></td>
                    <td><code>{{ $e->siret_formate ?? $e->siret }}</code></td>
                    <td>{{ $e->forme_juridique_label }}</td>
                    <td>{{ $e->ville }}</td>
                    <td>{{ $e->pays }}</td>
                    <td><span class="badge badge-info">{{ $e->documents_count ?? 0 }}</span></td>
                    <td><a href="{{ route('back.juridique.entreprises.show', $e) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a><a href="{{ route('back.juridique.entreprises.edit', $e) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>
                </tr>
                @empty <td><td colspan="7" class="text-center">Aucune entreprise</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $entreprises])</div>
</div>
@endsection