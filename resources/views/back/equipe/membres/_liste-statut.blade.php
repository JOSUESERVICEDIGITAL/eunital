<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.equipe.membres.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Membre</th>
                    <th>Département</th>
                    <th>Poste</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($membres as $membre)
                    <tr>
                        <td>{{ $membre->id }}</td>
                        <td>{{ $membre->nom }} {{ $membre->prenom }}</td>
                        <td>{{ $membre->departement->nom ?? 'Non défini' }}</td>
                        <td>{{ $membre->poste->nom ?? 'Non défini' }}</td>
                        <td><span class="badge rounded-pill text-bg-{{ $couleurBadge }}">{{ $texteBadge }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('back.equipe.membres.details', $membre) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Aucun membre trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $membres->links() }}</div>
</div>