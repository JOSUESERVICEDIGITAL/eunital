<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-camera-retro"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $captationStudio->titre }}</div>
                    <div class="mini-label text-muted">{{ ucfirst($captationStudio->type) }}</div>
                </div>
            </div>

            @php
                $badge = match($captationStudio->statut) {
                    'planifie' => 'primary',
                    'en_cours' => 'warning',
                    'termine' => 'success',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst(str_replace('_', ' ', $captationStudio->statut)) }}
            </span>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Événement</div>
                <div class="fw-semibold">{{ $captationStudio->evenement->titre ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Lieu</div>
                <div class="fw-semibold">{{ $captationStudio->lieu ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Date</div>
                <div class="fw-semibold">
                    {{ $captationStudio->date ? \Carbon\Carbon::parse($captationStudio->date)->format('d/m/Y') : '—' }}
                </div>
            </div>

            <div class="col-6">
                <div class="mini-label">Type</div>
                <div class="fw-semibold">{{ ucfirst($captationStudio->type) }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $captationStudio->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-studio.captations.details', $captationStudio) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-studio.captations.modifier', $captationStudio) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsCaptation{{ $captationStudio->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-studio.captations._modales', ['captationStudio' => $captationStudio])
</div>