<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi commercial</div>
            <h5 class="mb-0">Liste des commandes studio</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Commande</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($commandes as $commandeStudio)
                    @php
                        $badge = match($commandeStudio->statut) {
                            'en_attente' => 'warning',
                            'en_cours' => 'primary',
                            'livre' => 'success',
                            default => 'secondary'
                        };

                        $statusLabel = match($commandeStudio->statut) {
                            'en_attente' => 'En attente',
                            'en_cours' => 'En cours',
                            'livre' => 'Livrée',
                            default => ucfirst($commandeStudio->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $commandeStudio->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-file-signature"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $commandeStudio->titre }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($commandeStudio->description ?: 'Aucune description.', 80) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="fw-semibold">{{ $commandeStudio->client->nom ?? '—' }}</div>
                            <div class="small text-muted">{{ $commandeStudio->client->telephone ?? 'Aucun téléphone' }}</div>
                        </td>

                        <td>
                            <span class="badge bg-light text-dark border rounded-pill">
                                {{ ucfirst($commandeStudio->type ?? 'non défini') }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td>
                            {{ $commandeStudio->created_at ? $commandeStudio->created_at->format('d/m/Y') : '—' }}
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-studio.commandes.details', $commandeStudio) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsCommandeStudio{{ $commandeStudio->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-studio.commandes._modales', ['commandeStudio' => $commandeStudio])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-file-signature"></i>
                                </div>
                                <h6 class="mb-1">Aucune commande studio trouvée</h6>
                                <p class="text-muted mb-3">Commence par enregistrer une nouvelle commande client.</p>
                                <a href="{{ route('back.chambre-studio.commandes.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    <i class="fa-solid fa-plus me-1"></i> Nouvelle commande
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $commandes->links() }}
    </div>
</div>