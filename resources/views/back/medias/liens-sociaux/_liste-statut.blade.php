<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.medias.liens-sociaux.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>URL</th>
                    <th>Emplacement</th>
                    <th>Ordre</th>
                </tr>
            </thead>
            <tbody>
                @forelse($liensSociaux as $lienSocial)
                    <tr>
                        <td>{{ $lienSocial->id }}</td>
                        <td>{{ $lienSocial->nom }}</td>
                        <td class="text-truncate" style="max-width: 250px;">{{ $lienSocial->url }}</td>
                        <td>{{ ucfirst($lienSocial->emplacement) }}</td>
                        <td>{{ $lienSocial->ordre_affichage }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Aucun lien trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $liensSociaux->links() }}</div>
</div>