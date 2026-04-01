<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.equipe.postes.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Poste</th>
                    <th>Département</th>
                    <th>Membres</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($postes as $poste)
                    <tr>
                        <td>{{ $poste->id }}</td>
                        <td>{{ $poste->nom }}</td>
                        <td>{{ $poste->departement->nom ?? 'Non défini' }}</td>
                        <td>{{ $poste->membres_count }}</td>
                        <td><span class="badge rounded-pill text-bg-{{ $couleurBadge }}">{{ $texteBadge }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Aucun poste trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $postes->links() }}</div>
</div>