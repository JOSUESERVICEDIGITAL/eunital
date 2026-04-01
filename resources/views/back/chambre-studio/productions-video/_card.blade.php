<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-film"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $video->titre }}</div>
                    <div class="mini-label text-muted">
                        {{ ucfirst($video->type) }}
                    </div>
                </div>
            </div>

            {{-- STATUT --}}
            @php
                $badge = match($video->statut) {
                    'tournage' => 'primary',
                    'montage' => 'warning',
                    'validation' => 'info',
                    'livre' => 'success',
                    'archive' => 'dark',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst($video->statut) }}
            </span>
        </div>

        {{-- DESCRIPTION --}}
        <div class="mb-3 small text-muted">
            {{ \Illuminate\Support\Str::limit($video->description ?: 'Aucune description disponible.', 90) }}
        </div>

        {{-- INFOS --}}
        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Client</div>
                <div class="fw-semibold">
                    {{ $video->client->nom ?? '—' }}
                </div>
            </div>

            <div class="col-6">
                <div class="mini-label">Projet</div>
                <div class="fw-semibold">
                    {{ $video->projet->titre ?? '—' }}
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="d-flex justify-content-between align-items-center mt-auto">

            <div class="mini-label">
                #{{ $video->id }}
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-studio.productions-video.details', $video) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-studio.productions-video.modifier', $video) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsVideo{{ $video->id }}">
                    Actions
                </button>
            </div>

        </div>

    </div>

    {{-- MODALE --}}
    @include('back.chambre-studio.productions-video._modales', ['video' => $video])
</div>