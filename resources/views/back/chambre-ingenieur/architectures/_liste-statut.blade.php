<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.chambre-ingenieur.architectures.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Version</th>
                    <th>Statut</th>
                    <th>Diagramme</th>
                </tr>
            </thead>
            <tbody>
                @forelse($architectures as $architecture)
                    <tr>
                        <td>{{ $architecture->id }}</td>
                        <td>{{ $architecture->titre }}</td>
                        <td>{{ $architecture->version }}</td>
                        <td>{{ ucfirst($architecture->statut) }}</td>
                        <td>{{ $architecture->diagramme ? 'Oui' : 'Non' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Aucune architecture trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $architectures->links() }}</div>
</div>