<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-cubes"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $maquette->titre }}</div>
                    <div class="mini-label text-muted">{{ $maquette->support ?: 'Sans support défini' }}</div>
                </div>
            </div>

            @php
                $badge = match($maquette->statut) {
                    'creation' => 'warning',
                    'validation' => 'info',
                    'livre' => 'success',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst(str_replace('_', ' ', $maquette->statut)) }}
            </span>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Support</div>
                <div class="fw-semibold">{{ $maquette->support ?: '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Statut</div>
                <div class="fw-semibold">{{ ucfirst($maquette->statut) }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Fichier</div>
                <div class="fw-semibold">{{ $maquette->fichier ?: '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $maquette->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-graphisme.maquettes.details', $maquette) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <a href="{{ route('back.chambre-graphisme.maquettes.modifier', $maquette) }}"
                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    Modifier
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsMaquette{{ $maquette->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-graphisme.maquettes-graphiques._modales', ['maquette' => $maquette])
</div>