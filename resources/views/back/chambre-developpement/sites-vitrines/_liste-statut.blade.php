<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-developpement.sites-vitrines.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Tous</a>
            <a href="{{ route('back.chambre-developpement.sites-vitrines.maquettes') }}" class="btn btn-outline-secondary rounded-pill px-4">Maquettes</a>
            <a href="{{ route('back.chambre-developpement.sites-vitrines.developpement') }}" class="btn btn-outline-primary rounded-pill px-4">Développement</a>
            <a href="{{ route('back.chambre-developpement.sites-vitrines.livres') }}" class="btn btn-outline-success rounded-pill px-4">Livrés</a>
            <a href="{{ route('back.chambre-developpement.sites-vitrines.en_ligne') }}" class="btn btn-outline-info rounded-pill px-4">En ligne</a>
            <a href="{{ route('back.chambre-developpement.sites-vitrines.creer') }}" class="btn btn-primary rounded-pill px-4">
                Nouveau site
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Site</th>
                    <th>Client</th>
                    <th>Statut</th>
                    <th>Livraison prévue</th>
                    <th>Auteur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sites as $site)
                    <tr>
                        <td>{{ $site->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $site->titre }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($site->description, 70) }}</div>
                        </td>
                        <td>{{ $site->client ?: '—' }}</td>
                        <td>
                            <span class="badge rounded-pill text-bg-secondary">
                                {{ str_replace('_', ' ', ucfirst($site->statut)) }}
                            </span>
                        </td>
                        <td>
                            {{ $site->date_livraison_prevue ? $site->date_livraison_prevue->format('d/m/Y') : '—' }}
                        </td>
                        <td>{{ $site->auteur->name ?? '—' }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-developpement.sites-vitrines.details', $site) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-developpement.sites-vitrines.modifier', $site) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppressionSiteVitrine{{ $site->id }}">
                                    Supprimer
                                </button>
                            </div>

                            @include('back.chambre-developpement.sites-vitrines._modales', ['site' => $site])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            Aucun site vitrine trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $sites->links() }}
    </div>
</div>
