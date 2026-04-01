<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi relation client</div>
            <h5 class="mb-0">Liste des clients studio</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clients as $clientStudio)
                    @php
                        $badge = match($clientStudio->type) {
                            'artiste' => 'primary',
                            'entreprise' => 'success',
                            'particulier' => 'warning',
                            default => 'secondary'
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $clientStudio->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $clientStudio->nom }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($clientStudio->adresse ?: 'Aucune adresse renseignée.', 70) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ ucfirst($clientStudio->type ?? 'non défini') }}
                            </span>
                        </td>

                        <td>{{ $clientStudio->telephone ?: '—' }}</td>
                        <td>{{ $clientStudio->email ?: '—' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($clientStudio->adresse ?: '—', 45) }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-studio.clients.details', $clientStudio) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsClientStudio{{ $clientStudio->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-studio.clients._modales', ['clientStudio' => $clientStudio])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <h6 class="mb-1">Aucun client studio trouvé</h6>
                                <p class="text-muted mb-3">Commence par enregistrer un artiste, une entreprise ou un particulier.</p>
                                <a href="{{ route('back.chambre-studio.clients.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    <i class="fa-solid fa-plus me-1"></i> Nouveau client
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $clients->links() }}
    </div>
</div>