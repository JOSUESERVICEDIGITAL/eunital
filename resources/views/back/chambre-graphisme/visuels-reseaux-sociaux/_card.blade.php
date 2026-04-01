<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $visuel->titre }}</div>
                    <div class="mini-label text-muted">{{ ucfirst($visuel->plateforme) }}</div>
                </div>
            </div>

            @php
                $badge = match($visuel->statut) {
                    'creation' => 'secondary',
                    'programme' => 'warning',
                    'publie' => 'success',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst(str_replace('_', ' ', $visuel->statut)) }}
            </span>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Client</div>
                <div class="fw-semibold">{{ $visuel->client->nom ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Plateforme</div>
                <div class="fw-semibold">{{ ucfirst($visuel->plateforme) }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Publication</div>
                <div class="fw-semibold">
                    {{ $visuel->date_publication ? \Carbon\Carbon::parse($visuel->date_publication)->format('d/m/Y H:i') : '—' }}
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $visuel->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-graphisme.social.details', $visuel) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-graphisme.social.modifier', $visuel) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsVisuel{{ $visuel->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-graphisme.visuels-reseaux-sociaux._modales', ['visuel' => $visuel])
</div>