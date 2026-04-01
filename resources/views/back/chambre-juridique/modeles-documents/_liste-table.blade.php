<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="p-4 border-bottom bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-1">Bibliothèque des modèles</h5>
                    <small class="text-muted">Modèles standards pour génération, téléchargement et diffusion documentaire du hub.</small>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Modèle</th>
                        <th>Type</th>
                        <th>Version</th>
                        <th>Statut</th>
                        <th>Auteur</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($modeles as $modele)
                        <tr>
                            <td>#{{ $modele->id }}</td>

                            <td>
                                <div class="fw-bold">{{ $modele->nom }}</div>
                                <div class="small text-muted">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($modele->contenu), 70) ?: 'Sans contenu résumé.' }}
                                </div>
                            </td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst(str_replace('_', ' ', $modele->type_document)) }}
                                </span>
                            </td>

                            <td>{{ $modele->version ?? '—' }}</td>

                            <td>
                                <span class="badge text-bg-{{ $modele->actif ? 'success' : 'secondary' }}">
                                    {{ $modele->actif ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>

                            <td>{{ $modele->auteur->name ?? '—' }}</td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-juridique.modeles-documents.details', $modele) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-juridique.modeles-documents.modifier', $modele) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsModele{{ $modele->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-juridique.modeles-documents._modales', ['modele' => $modele])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                Aucun modèle de document trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $modeles->links() }}
        </div>
    </div>
</div>
