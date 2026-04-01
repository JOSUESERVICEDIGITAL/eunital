<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi des créations</div>
            <h5 class="mb-0">Liste des créations graphiques</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Création</th>
                    <th>Client</th>
                    <th>Projet</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Auteur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($creations as $creation)
                    @php
                        $badge = match($creation->statut) {
                            'brouillon' => 'secondary',
                            'en_cours' => 'warning',
                            'validation' => 'info',
                            'livre' => 'success',
                            'archive' => 'dark',
                            default => 'secondary'
                        };

                        $statusLabel = match($creation->statut) {
                            'brouillon' => 'Brouillon',
                            'en_cours' => 'En cours',
                            'validation' => 'Validation',
                            'livre' => 'Livrée',
                            'archive' => 'Archivée',
                            default => ucfirst($creation->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $creation->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-pen-ruler"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $creation->titre }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($creation->description ?: 'Aucune description fournie.', 80) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="fw-semibold">{{ $creation->client->nom ?? '—' }}</div>
                        </td>

                        <td>{{ $creation->projet->titre ?? '—' }}</td>

                        <td>
                            <span class="badge bg-light text-dark border rounded-pill">
                                {{ ucfirst($creation->type) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td>{{ $creation->auteur->name ?? '—' }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-graphisme.creations.details', $creation) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-graphisme.creations.modifier', $creation) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsCreation{{ $creation->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-graphisme.creations-graphiques._modales', ['creation' => $creation])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-pen-ruler"></i>
                                </div>
                                <h6 class="mb-1">Aucune création graphique trouvée</h6>
                                <p class="text-muted mb-3">Commence par créer un nouveau livrable graphique.</p>
                                <a href="{{ route('back.chambre-graphisme.creations.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    Nouvelle création
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $creations->links() }}
    </div>
</div>