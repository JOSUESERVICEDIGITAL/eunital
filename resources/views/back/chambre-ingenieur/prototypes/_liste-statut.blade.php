<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.chambre-ingenieur.prototypes.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Statut</th>
                    <th>Démo</th>
                    <th>Dépôt</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prototypes as $prototype)
                    <tr>
                        <td>{{ $prototype->id }}</td>
                        <td>{{ $prototype->titre }}</td>
                        <td>{{ str_replace('_', ' ', ucfirst($prototype->statut)) }}</td>
                        <td>{{ $prototype->lien_demo ? 'Oui' : 'Non' }}</td>
                        <td>{{ $prototype->depot_source ? 'Oui' : 'Non' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Aucun prototype trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $prototypes->links() }}</div>
</div>