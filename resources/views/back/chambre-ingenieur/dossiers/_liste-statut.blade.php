<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.chambre-ingenieur.dossiers.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dossier</th>
                    <th>Type</th>
                    <th>Version</th>
                    <th>Document</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dossiers as $dossier)
                    <tr>
                        <td>{{ $dossier->id }}</td>
                        <td>{{ $dossier->titre }}</td>
                        <td>{{ ucfirst($dossier->type_dossier) }}</td>
                        <td>{{ $dossier->version }}</td>
                        <td>{{ $dossier->document_principal ? 'Oui' : 'Non' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Aucun dossier trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $dossiers->links() }}</div>
</div>