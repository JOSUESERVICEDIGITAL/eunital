<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi opérationnel</div>
            <h5 class="mb-0">Liste des captations</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Captation</th>
                    <th>Événement lié</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($captations as $captation)
                    @php
                        $badge = match($captation->statut) {
                            'planifie' => 'primary',
                            'en_cours' => 'warning',
                            'termine' => 'success',
                            default => 'secondary'
                        };

                        $statusLabel = match($captation->statut) {
                            'planifie' => 'Planifiée',
                            'en_cours' => 'En cours',
                            'termine' => 'Terminée',
                            default => ucfirst($captation->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $captation->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-camera-retro"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $captation->titre }}</div>
                                    <div class="small text-muted">
                                        {{ $captation->evenement->titre ?? 'Aucun événement lié' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $captation->evenement->titre ?? '—' }}</td>

                        <td>{{ $captation->date ? \Carbon\Carbon::parse($captation->date)->format('d/m/Y') : '—' }}</td>

                        <td>{{ $captation->lieu ?? '—' }}</td>

                        <td>
                            <span class="badge bg-light text-dark border rounded-pill">
                                {{ ucfirst($captation->type) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-studio.captations.details', $captation) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-studio.captations.modifier', $captation) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsCaptation{{ $captation->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-studio.captations._modales', ['captationStudio' => $captation])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-camera-retro"></i>
                                </div>
                                <h6 class="mb-1">Aucune captation trouvée</h6>
                                <p class="text-muted mb-3">Commence par ajouter une nouvelle captation studio.</p>
                                <a href="{{ route('back.chambre-studio.captations.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    <i class="fa-solid fa-plus me-1"></i> Nouvelle captation
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $captations->links() }}
    </div>
</div>