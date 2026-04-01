<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <a href="{{ route('back.categories.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-2"></i>Retour à toutes les catégories
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Catégorie</th>
                    <th>Parent</th>
                    <th>Sous-catégories</th>
                    <th>Articles</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $categorie->nom }}</div>
                            <div class="text-muted small">{{ $categorie->slug }}</div>
                        </td>
                        <td>{{ $categorie->categorieParente->nom ?? 'Aucune' }}</td>
                        <td>{{ $categorie->sousCategories->count() }}</td>
                        <td>{{ $categorie->articles->count() }}</td>
                        <td>
                            <span class="badge rounded-pill text-bg-{{ $couleurBadge }}">{{ $texteBadge }}</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('back.categories.details', $categorie) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                            <a href="{{ route('back.categories.modifier', $categorie) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Aucune catégorie trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>