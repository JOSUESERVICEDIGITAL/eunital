<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi planning studio</div>
            <h5 class="mb-0">Liste des réservations</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Réservation</th>
                    <th>Client</th>
                    <th>Salle</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($reservations as $reservationStudio)
                    @php
                        $badge = match($reservationStudio->statut) {
                            'reserve' => 'warning',
                            'confirme' => 'success',
                            'annule' => 'danger',
                            default => 'secondary'
                        };

                        $statusLabel = match($reservationStudio->statut) {
                            'reserve' => 'Réservée',
                            'confirme' => 'Confirmée',
                            'annule' => 'Annulée',
                            default => ucfirst($reservationStudio->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $reservationStudio->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">
                                        Réservation {{ $reservationStudio->client->nom ?? 'Studio' }}
                                    </div>
                                    <div class="small text-muted">
                                        Créée le {{ $reservationStudio->created_at ? $reservationStudio->created_at->format('d/m/Y') : '—' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="fw-semibold">{{ $reservationStudio->client->nom ?? '—' }}</div>
                            <div class="small text-muted">{{ $reservationStudio->client->telephone ?? 'Aucun téléphone' }}</div>
                        </td>

                        <td>{{ $reservationStudio->salle ?: '—' }}</td>

                        <td>
                            {{ $reservationStudio->date_debut ? \Carbon\Carbon::parse($reservationStudio->date_debut)->format('d/m/Y H:i') : '—' }}
                        </td>

                        <td>
                            {{ $reservationStudio->date_fin ? \Carbon\Carbon::parse($reservationStudio->date_fin)->format('d/m/Y H:i') : '—' }}
                        </td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-studio.reservations.details', $reservationStudio) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-studio.reservations.modifier', $reservationStudio) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalActionsReservationStudio{{ $reservationStudio->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-studio.reservations._modales', ['reservationStudio' => $reservationStudio])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                                <h6 class="mb-1">Aucune réservation studio trouvée</h6>
                                <p class="text-muted mb-3">Commence par enregistrer une nouvelle réservation de salle ou de session.</p>
                                <a href="{{ route('back.chambre-studio.reservations.creer') }}" class="btn btn-dark rounded-pill px-4">
                                    <i class="fa-solid fa-plus me-1"></i> Nouvelle réservation
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $reservations->links() }}
    </div>
</div>