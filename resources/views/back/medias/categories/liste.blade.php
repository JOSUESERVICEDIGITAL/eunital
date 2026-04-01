@extends('back.layouts.principal')

@section('title', 'Catégories média')
@section('page_title', 'Catégories média')
@section('page_subtitle', 'Organisation et classement des ressources médias du hub.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h4 class="fw-bold mb-1">Liste des catégories</h4>
                <p class="text-muted mb-0">Organisation des médias par famille.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('back.medias.categories.actives') }}" class="btn btn-outline-success rounded-pill px-4">Actives</a>
                <a href="{{ route('back.medias.categories.inactives') }}" class="btn btn-outline-secondary rounded-pill px-4">Inactives</a>
                <a href="{{ route('back.medias.categories.creer') }}" class="btn btn-primary rounded-pill px-4">Ajouter une catégorie</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th>Médias</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categoriesMedias as $categorieMedia)
                        <tr>
                            <td>{{ $categorieMedia->id }}</td>
                            <td>{{ $categorieMedia->nom }}</td>
                            <td>{{ $categorieMedia->slug }}</td>
                            <td>{{ $categorieMedia->medias_count }}</td>
                            <td>
                                @if($categorieMedia->est_actif)
                                    <span class="badge rounded-pill text-bg-success">Active</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('back.medias.categories.details', $categorieMedia) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                <a href="{{ route('back.medias.categories.modifier', $categorieMedia) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">Aucune catégorie trouvée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $categoriesMedias->links() }}</div>
    </div>
@endsection