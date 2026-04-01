<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $clientStudio->nom }}</div>
                    <div class="mini-label text-muted">{{ ucfirst($clientStudio->type ?? 'non défini') }}</div>
                </div>
            </div>

            @php
                $badge = match($clientStudio->type) {
                    'artiste' => 'primary',
                    'entreprise' => 'success',
                    'particulier' => 'warning',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst($clientStudio->type ?? 'non défini') }}
            </span>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Téléphone</div>
                <div class="fw-semibold">{{ $clientStudio->telephone ?: '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Email</div>
                <div class="fw-semibold">{{ $clientStudio->email ?: '—' }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Adresse</div>
                <div class="fw-semibold">{{ \Illuminate\Support\Str::limit($clientStudio->adresse ?: '—', 80) }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $clientStudio->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-studio.clients.details', $clientStudio) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsClientStudio{{ $clientStudio->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-studio.clients._modales', ['clientStudio' => $clientStudio])
</div>