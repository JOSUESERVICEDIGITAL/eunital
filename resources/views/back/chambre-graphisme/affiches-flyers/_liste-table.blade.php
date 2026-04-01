<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi des supports</div>
            <h5 class="mb-0">Liste des affiches et flyers</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Support</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Fichier</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($affiches as $affiche)
                    @php
                        $badge = match($affiche->statut) {
                            'creation' => 'warning',
                            'validation' => 'info',
                            'livre' => 'success',
                            default => 'secondary'
                        };

                        $statusLabel = match($affiche->statut) {
                            'creation' => 'Création',
                            'validation' => 'Validation',
                            'livre' => 'Livré',
                            default => ucfirst($affiche->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $affiche->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-file-image"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $affiche->titre }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($affiche->description ?: 'Aucune description fournie.', 80) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $affiche->client->nom ?? '—' }}</td>

                        <td>
                            <span class="badge bg-light text-dark border rounded-pill">
                                {{ ucfirst($affiche->type) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td>{{ $affiche->fichier ?: '—' }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-graphisme.affiches.details', $affiche) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-graphisme.affiches.modifier', $affiche) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsAffiche{{ $affiche->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-graphisme.affiches-flyers._modales', ['affiche' => $affiche])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-file-image"></i>
                                </div>
                                <h6 class="mb-1">Aucun support trouvé</h6>
                                <p class="text-muted mb-3">Commence par créer une nouvelle affiche ou un nouveau flyer.</p>
                                <a href="{{ route('back.chambre-graphisme.affiches.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    Nouveau support
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $affiches->links() }}
    </div>
</div>