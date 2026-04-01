<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-pen-ruler"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $creation->titre }}</div>
                    <div class="mini-label text-muted">{{ ucfirst($creation->type) }}</div>
                </div>
            </div>

            @php
                $badge = match($creation->statut) {
                    'brouillon' => 'secondary',
                    'en_cours' => 'warning',
                    'validation' => 'info',
                    'livre' => 'success',
                    'archive' => 'dark',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst(str_replace('_', ' ', $creation->statut)) }}
            </span>
        </div>

        <div class="mb-3 small text-muted">
            {{ \Illuminate\Support\Str::limit($creation->description ?: 'Aucune description disponible.', 90) }}
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Client</div>
                <div class="fw-semibold">{{ $creation->client->nom ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Projet</div>
                <div class="fw-semibold">{{ $creation->projet->titre ?? '—' }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Auteur</div>
                <div class="fw-semibold">{{ $creation->auteur->name ?? '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $creation->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-graphisme.creations.details', $creation) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-graphisme.creations.modifier', $creation) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsCreation{{ $creation->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-graphisme.creations-graphiques._modales', ['creation' => $creation])
</div>