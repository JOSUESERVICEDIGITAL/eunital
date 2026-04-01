<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi des mockups</div>
            <h5 class="mb-0">Liste des maquettes graphiques</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Maquette</th>
                    <th>Support</th>
                    <th>Fichier</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($maquettes as $maquette)
                    @php
                        $badge = match($maquette->statut) {
                            'creation' => 'warning',
                            'validation' => 'info',
                            'livre' => 'success',
                            default => 'secondary'
                        };

                        $statusLabel = match($maquette->statut) {
                            'creation' => 'Création',
                            'validation' => 'Validation',
                            'livre' => 'Livrée',
                            default => ucfirst($maquette->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $maquette->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-cubes"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $maquette->titre }}</div>
                                    <div class="small text-muted">
                                        {{ $maquette->support ?: 'Support non renseigné' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $maquette->support ?: '—' }}</td>
                        <td>{{ $maquette->fichier ?: '—' }}</td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-graphisme.maquettes.details', $maquette) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-graphisme.maquettes.modifier', $maquette) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsMaquette{{ $maquette->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-graphisme.maquettes-graphiques._modales', ['maquette' => $maquette])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-cubes"></i>
                                </div>
                                <h6 class="mb-1">Aucune maquette graphique trouvée</h6>
                                <p class="text-muted mb-3">Commence par créer une nouvelle maquette visuelle ou mockup.</p>
                                <a href="{{ route('back.chambre-graphisme.maquettes.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    Nouvelle maquette
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $maquettes->links() }}
    </div>
</div>