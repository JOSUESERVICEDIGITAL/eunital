<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <a href="{{ route('back.medias.fichiers.bibliotheque') }}" class="btn btn-outline-dark rounded-pill px-4">Retour bibliothèque</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Média</th>
                    <th>Catégorie</th>
                    <th>Visibilité</th>
                    <th>Auteur</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medias as $media)
                    <tr>
                        <td>{{ $media->id }}</td>
                        <td>{{ $media->titre }}</td>
                        <td>{{ $media->categorie->nom ?? 'Sans catégorie' }}</td>
                        <td>{{ $media->est_public ? 'Public' : 'Privé' }}</td>
                        <td>{{ $media->utilisateur->name ?? 'Système' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Aucun média trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $medias->links() }}</div>
</div>