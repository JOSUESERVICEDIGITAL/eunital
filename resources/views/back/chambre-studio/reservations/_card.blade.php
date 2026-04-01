<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $reservationStudio->client->nom ?? 'Client studio' }}</div>
                    <div class="mini-label text-muted">{{ $reservationStudio->salle ?: 'Salle non renseignée' }}</div>
                </div>
            </div>

            @php
                $badge = match($reservationStudio->statut) {
                    'reserve' => 'warning',
                    'confirme' => 'success',
                    'annule' => 'danger',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst(str_replace('_', ' ', $reservationStudio->statut)) }}
            </span>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Début</div>
                <div class="fw-semibold">
                    {{ $reservationStudio->date_debut ? \Carbon\Carbon::parse($reservationStudio->date_debut)->format('d/m/Y H:i') : '—' }}
                </div>
            </div>

            <div class="col-6">
                <div class="mini-label">Fin</div>
                <div class="fw-semibold">
                    {{ $reservationStudio->date_fin ? \Carbon\Carbon::parse($reservationStudio->date_fin)->format('d/m/Y H:i') : '—' }}
                </div>
            </div>

            <div class="col-12">
                <div class="mini-label">Salle</div>
                <div class="fw-semibold">{{ $reservationStudio->salle ?: '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $reservationStudio->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-studio.reservations.details', $reservationStudio) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-studio.reservations.modifier', $reservationStudio) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsReservationStudio{{ $reservationStudio->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-studio.reservations._modales', ['reservationStudio' => $reservationStudio])
</div>