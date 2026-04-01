<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi des interfaces</div>
            <h5 class="mb-0">Liste des designs UI/UX</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Design</th>
                    <th>Projet</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Fichier</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($designs as $design)
                    @php
                        $badge = match($design->statut) {
                            'conception' => 'warning',
                            'test' => 'info',
                            'valide' => 'success',
                            default => 'secondary'
                        };

                        $statusLabel = match($design->statut) {
                            'conception' => 'Conception',
                            'test' => 'Test',
                            'valide' => 'Validé',
                            default => ucfirst($design->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $design->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-object-group"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $design->titre }}</div>
                                    <div class="small text-muted">
                                        {{ $design->projet->titre ?? 'Aucun projet lié' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $design->projet->titre ?? '—' }}</td>

                        <td>
                            <span class="badge bg-light text-dark border rounded-pill">
                                {{ ucfirst($design->type) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td>{{ $design->fichier ?: '—' }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-graphisme.uiux.details', $design) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-graphisme.uiux.modifier', $design) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsUiux{{ $design->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-graphisme.uiux-designs._modales', ['design' => $design])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-object-group"></i>
                                </div>
                                <h6 class="mb-1">Aucun design UI/UX trouvé</h6>
                                <p class="text-muted mb-3">Commence par créer un nouveau wireframe, une maquette ou un prototype.</p>
                                <a href="{{ route('back.chambre-graphisme.uiux.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    Nouveau design
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $designs->links() }}
    </div>
</div>