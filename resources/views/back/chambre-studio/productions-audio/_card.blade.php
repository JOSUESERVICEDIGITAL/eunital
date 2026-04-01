<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-music"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $audio->titre }}</div>
                    <div class="mini-label text-muted">{{ ucfirst($audio->type) }}</div>
                </div>
            </div>

            @php
                $badge = match($audio->statut) {
                    'enregistrement' => 'primary',
                    'mixage' => 'warning',
                    'mastering' => 'info',
                    'livre' => 'success',
                    'archive' => 'dark',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst($audio->statut) }}
            </span>
        </div>

        <div class="mb-3 small text-muted">
            {{ \Illuminate\Support\Str::limit($audio->description ?: 'Aucune description disponible.', 90) }}
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Client</div>
                <div class="fw-semibold">{{ $audio->client->nom ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Projet</div>
                <div class="fw-semibold">{{ $audio->projet->titre ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Durée</div>
                <div class="fw-semibold">{{ $audio->duree ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Auteur</div>
                <div class="fw-semibold">{{ $audio->auteur->name ?? '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $audio->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-studio.productions-audio.details', $audio) }}"
                    class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-studio.productions-audio.modifier', $audio) }}"
                    class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalActionsAudio{{ $audio->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-studio.productions-audio._modales', ['audio' => $audio])
</div>