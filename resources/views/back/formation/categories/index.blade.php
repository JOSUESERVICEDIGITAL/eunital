@extends('back.formation.layouts.app')

@section('title', 'Catégories de modules')
@section('page_title', 'Gestion des catégories')
@section('page_subtitle', 'Organisation des modules de formation par catégories')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-2"></i>
            Liste des catégories
        </h3>
        <div class="card-tools">
            <a href="{{ route('back.formation.categories-modules.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nouvelle catégorie
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th style="width: 80px">Modules</th>
                        <th style="width: 100px">Statut</th>
                        <th style="width: 120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->id }}</td>
                        <td>
                            <strong>{{ $categorie->nom }}</strong>
                            <br>
                            <small class="text-muted">Ordre: {{ $categorie->ordre }}</small>
                        </td>
                        <td><code>{{ $categorie->slug }}</code></td>
                        <td>{{ Str::limit($categorie->description, 60) }}</td>
                        <td>
                            <span class="badge badge-info">{{ $categorie->modules_count }}</span>
                        </td>
                        <td>
                            @include('back.formation.partials.status-badge', ['status' => $categorie->is_active ? 'active' : 'inactive'])
                        </td>
                        <td>
                            @include('back.formation.partials.table-actions', [
                                'showRoute' => route('back.formation.categories-modules.show', $categorie),
                                'editRoute' => route('back.formation.categories-modules.edit', $categorie),
                                'deleteRoute' => route('back.formation.categories-modules.destroy', $categorie)
                            ])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-folder-open fa-2x text-muted mb-2 d-block"></i>
                            Aucune catégorie trouvée
                            <br>
                            <a href="{{ route('back.formation.categories-modules.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Créer la première catégorie
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $categories])
    </div>
</div>
@endsection