<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <a href="{{ route('back.articles.tous') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-2"></i>Retour à tous les articles
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Article</th>
                    <th>Catégorie</th>
                    <th>Auteur</th>
                    <th>Statut</th>
                    <th>Vues</th>
                    <th>Publication</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $article->titre }}</div>
                            <div class="text-muted small">{{ $article->slug }}</div>
                        </td>
                        <td>{{ $article->categorie->nom ?? 'Non classé' }}</td>
                        <td>{{ $article->auteur->name ?? 'Inconnu' }}</td>
                        <td>
                            <span class="badge rounded-pill text-bg-{{ $couleurBadge }}">{{ $texteBadge }}</span>
                        </td>
                        <td>{{ $article->nombre_vues }}</td>
                        <td>{{ $article->date_publication ? $article->date_publication->format('d/m/Y') : 'Non publiée' }}</td>
                        <td class="text-end">
                            <a href="{{ route('back.articles.details', $article) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                            <a href="{{ route('back.articles.modifier', $article) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Aucun article trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>