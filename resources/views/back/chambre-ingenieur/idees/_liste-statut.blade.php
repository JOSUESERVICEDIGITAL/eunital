<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.chambre-ingenieur.idees.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Idée</th>
                    <th>Priorité</th>
                    <th>Statut</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
                @forelse($idees as $idee)
                    <tr>
                        <td>{{ $idee->id }}</td>
                        <td>{{ $idee->titre }}</td>
                        <td>{{ ucfirst($idee->niveau_priorite) }}</td>
                        <td>{{ str_replace('_', ' ', ucfirst($idee->statut)) }}</td>
                        <td>{{ $idee->responsable->name ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Aucune idée trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $idees->links() }}</div>
</div>