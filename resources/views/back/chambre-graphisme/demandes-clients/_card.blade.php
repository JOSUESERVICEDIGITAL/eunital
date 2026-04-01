<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $demande->titre }}</div>
                    <div class="mini-label text-muted">{{ $demande->client->nom ?? 'Sans client' }}</div>
                </div>
            </div>

            @php
                $badge = match($demande->statut) {
                    'en_attente' => 'secondary',
                    'en_cours' => 'warning',
                    'termine' => 'success',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst(str_replace('_', ' ', $demande->statut)) }}
            </span>
        </div>

        <div class="mb-3 small text-muted">
            {{ \Illuminate\Support\Str::limit($demande->description, 90) }}
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Type</div>
                <div class="fw-semibold">{{ ucfirst($demande->type) }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Priorité</div>
                <div class="fw-semibold">{{ ucfirst($demande->priorite) }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Client</div>
                <div class="fw-semibold">{{ $demande->client->nom ?? '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $demande->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-graphisme.clients-demandes.details', $demande) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-graphisme.clients-demandes.modifier', $demande) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsDemande{{ $demande->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-graphisme.demandes-clients._modales', ['demande' => $demande])
</div>
