<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi des briefs</div>
            <h5 class="mb-0">Liste des demandes clients</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Demande</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Priorité</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($demandes as $demande)
                    @php
                        $badge = match($demande->statut) {
                            'en_attente' => 'secondary',
                            'en_cours' => 'warning',
                            'termine' => 'success',
                            default => 'secondary'
                        };

                        $priorityBadge = match($demande->priorite) {
                            'faible' => 'light text-dark border',
                            'normale' => 'info',
                            'urgente' => 'danger',
                            default => 'secondary'
                        };

                        $statusLabel = match($demande->statut) {
                            'en_attente' => 'En attente',
                            'en_cours' => 'En cours',
                            'termine' => 'Terminée',
                            default => ucfirst($demande->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $demande->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-envelope-open-text"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $demande->titre }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($demande->description, 80) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $demande->client->nom ?? '—' }}</td>

                        <td>
                            <span class="badge bg-light text-dark border rounded-pill">
                                {{ ucfirst($demande->type) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $priorityBadge }} rounded-pill px-3">
                                {{ ucfirst($demande->priorite) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-graphisme.clients-demandes.details', $demande) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-graphisme.clients-demandes.modifier', $demande) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsDemande{{ $demande->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-graphisme.demandes-clients._modales', ['demande' => $demande])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-envelope-open-text"></i>
                                </div>
                                <h6 class="mb-1">Aucune demande client trouvée</h6>
                                <p class="text-muted mb-3">Commence par enregistrer un nouveau brief graphique client.</p>
                                <a href="{{ route('back.chambre-graphisme.clients-demandes.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    Nouvelle demande
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $demandes->links() }}
    </div>
</div>
