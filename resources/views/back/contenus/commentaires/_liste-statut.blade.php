<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <a href="{{ route('back.commentaires.tous') }}" class="btn btn-outline-dark rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-2"></i>Retour à tous les commentaires
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Auteur</th>
                    <th>Article</th>
                    <th>Commentaire</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($commentaires as $commentaire)
                    <tr>
                        <td>{{ $commentaire->id }}</td>
                        <td>{{ $commentaire->auteur->name ?? $commentaire->nom ?? 'Visiteur' }}</td>
                        <td>{{ $commentaire->article->titre ?? 'Article introuvable' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($commentaire->contenu, 80) }}</td>
                        <td>
                            <span class="badge rounded-pill text-bg-{{ $couleurBadge }}">{{ $texteBadge }}</span>
                        </td>
                        <td>{{ $commentaire->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('back.commentaires.details', $commentaire) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Aucun commentaire trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $commentaires->links() }}
    </div>
</div>