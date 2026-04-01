<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-file-image"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $affiche->titre }}</div>
                    <div class="mini-label text-muted">{{ ucfirst($affiche->type) }}</div>
                </div>
            </div>

            @php
                $badge = match($affiche->statut) {
                    'creation' => 'warning',
                    'validation' => 'info',
                    'livre' => 'success',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst($affiche->statut) }}
            </span>
        </div>

        <div class="mb-3 small text-muted">
            {{ \Illuminate\Support\Str::limit($affiche->description ?: 'Aucune description disponible.', 90) }}
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Client</div>
                <div class="fw-semibold">{{ $affiche->client->nom ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Type</div>
                <div class="fw-semibold">{{ ucfirst($affiche->type) }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Fichier</div>
                <div class="fw-semibold">{{ $affiche->fichier ?: '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $affiche->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-graphisme.affiches.details', $affiche) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-graphisme.affiches.modifier', $affiche) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsAffiche{{ $affiche->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-graphisme.affiches-flyers._modales', ['affiche' => $affiche])
</div>