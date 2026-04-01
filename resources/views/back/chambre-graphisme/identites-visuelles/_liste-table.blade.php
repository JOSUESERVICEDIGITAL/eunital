<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi du branding</div>
            <h5 class="mb-0">Liste des identités visuelles</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Identité visuelle</th>
                    <th>Client</th>
                    <th>Palette</th>
                    <th>Typographie</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($identites as $identite)
                    @php
                        $badge = match($identite->statut) {
                            'creation' => 'warning',
                            'validation' => 'info',
                            'termine' => 'success',
                            default => 'secondary'
                        };

                        $statusLabel = match($identite->statut) {
                            'creation' => 'Création',
                            'validation' => 'Validation',
                            'termine' => 'Terminée',
                            default => ucfirst($identite->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $identite->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-fingerprint"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $identite->nom }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($identite->description ?: 'Aucune description fournie.', 80) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="fw-semibold">{{ $identite->client->nom ?? '—' }}</div>
                        </td>

                        <td>{{ $identite->palette_couleurs ?: '—' }}</td>
                        <td>{{ $identite->typographie ?: '—' }}</td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-graphisme.identites.details', $identite) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-graphisme.identites.modifier', $identite) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsIdentite{{ $identite->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-graphisme.identites-visuelles._modales', ['identite' => $identite])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-fingerprint"></i>
                                </div>
                                <h6 class="mb-1">Aucune identité visuelle trouvée</h6>
                                <p class="text-muted mb-3">Commence par créer une nouvelle identité visuelle.</p>
                                <a href="{{ route('back.chambre-graphisme.identites.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    Nouvelle identité visuelle
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $identites->links() }}
    </div>
</div>