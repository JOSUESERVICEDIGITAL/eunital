<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-fingerprint"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $identite->nom }}</div>
                    <div class="mini-label text-muted">{{ $identite->client->nom ?? 'Sans client' }}</div>
                </div>
            </div>

            @php
                $badge = match($identite->statut) {
                    'creation' => 'warning',
                    'validation' => 'info',
                    'termine' => 'success',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst(str_replace('_', ' ', $identite->statut)) }}
            </span>
        </div>

        <div class="mb-3 small text-muted">
            {{ \Illuminate\Support\Str::limit($identite->description ?: 'Aucune description disponible.', 90) }}
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Palette</div>
                <div class="fw-semibold">{{ $identite->palette_couleurs ?: '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Typographie</div>
                <div class="fw-semibold">{{ $identite->typographie ?: '—' }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Logo</div>
                <div class="fw-semibold">{{ $identite->logo ?: '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $identite->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-graphisme.identites.details', $identite) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-graphisme.identites.modifier', $identite) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsIdentite{{ $identite->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-graphisme.identites-visuelles._modales', ['identite' => $identite])
</div>