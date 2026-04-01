<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi de publication</div>
            <h5 class="mb-0">Liste des visuels réseaux sociaux</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Visuel</th>
                    <th>Client</th>
                    <th>Plateforme</th>
                    <th>Date publication</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($visuels as $visuel)
                    @php
                        $badge = match($visuel->statut) {
                            'creation' => 'secondary',
                            'programme' => 'warning',
                            'publie' => 'success',
                            default => 'secondary'
                        };

                        $statusLabel = match($visuel->statut) {
                            'creation' => 'Création',
                            'programme' => 'Programmé',
                            'publie' => 'Publié',
                            default => ucfirst($visuel->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $visuel->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $visuel->titre }}</div>
                                    <div class="small text-muted">
                                        {{ $visuel->fichier ?: 'Aucun fichier renseigné.' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $visuel->client->nom ?? '—' }}</td>

                        <td>
                            <span class="badge bg-light text-dark border rounded-pill">
                                {{ ucfirst($visuel->plateforme) }}
                            </span>
                        </td>

                        <td>
                            {{ $visuel->date_publication ? \Carbon\Carbon::parse($visuel->date_publication)->format('d/m/Y H:i') : '—' }}
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-graphisme.social.details', $visuel) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-graphisme.social.modifier', $visuel) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsVisuel{{ $visuel->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-graphisme.visuels-reseaux-sociaux._modales', ['visuel' => $visuel])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </div>
                                <h6 class="mb-1">Aucun visuel social trouvé</h6>
                                <p class="text-muted mb-3">Commence par créer un nouveau visuel pour les réseaux sociaux.</p>
                                <a href="{{ route('back.chambre-graphisme.social.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    Nouveau visuel
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $visuels->links() }}
    </div>
</div>