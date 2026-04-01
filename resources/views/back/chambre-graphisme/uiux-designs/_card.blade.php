<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-object-group"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $design->titre }}</div>
                    <div class="mini-label text-muted">{{ ucfirst($design->type) }}</div>
                </div>
            </div>

            @php
                $badge = match($design->statut) {
                    'conception' => 'warning',
                    'test' => 'info',
                    'valide' => 'success',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst($design->statut) }}
            </span>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Projet</div>
                <div class="fw-semibold">{{ $design->projet->titre ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Type</div>
                <div class="fw-semibold">{{ ucfirst($design->type) }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Fichier</div>
                <div class="fw-semibold">{{ $design->fichier ?: '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $design->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-graphisme.uiux.details', $design) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-graphisme.uiux.modifier', $design) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsUiux{{ $design->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-graphisme.uiux-designs._modales', ['design' => $design])
</div>