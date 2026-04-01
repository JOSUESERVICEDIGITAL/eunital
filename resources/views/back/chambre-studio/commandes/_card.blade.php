<div class="col-md-6 col-xl-4">
    <div class="content-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="table-avatar">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $commandeStudio->titre }}</div>
                    <div class="mini-label text-muted">{{ ucfirst($commandeStudio->type ?? 'non défini') }}</div>
                </div>
            </div>

            @php
                $badge = match($commandeStudio->statut) {
                    'en_attente' => 'warning',
                    'en_cours' => 'primary',
                    'livre' => 'success',
                    default => 'secondary'
                };
            @endphp

            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                {{ ucfirst(str_replace('_', ' ', $commandeStudio->statut)) }}
            </span>
        </div>

        <div class="mb-3 small text-muted">
            {{ \Illuminate\Support\Str::limit($commandeStudio->description ?: 'Aucune description disponible.', 90) }}
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="mini-label">Client</div>
                <div class="fw-semibold">{{ $commandeStudio->client->nom ?? '—' }}</div>
            </div>

            <div class="col-6">
                <div class="mini-label">Type</div>
                <div class="fw-semibold">{{ ucfirst($commandeStudio->type ?? '—') }}</div>
            </div>

            <div class="col-12">
                <div class="mini-label">Date</div>
                <div class="fw-semibold">{{ $commandeStudio->created_at ? $commandeStudio->created_at->format('d/m/Y') : '—' }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-auto">
            <div class="mini-label">#{{ $commandeStudio->id }}</div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.chambre-studio.commandes.details', $commandeStudio) }}"
                   class="btn btn-sm btn-light rounded-pill px-3">
                    Voir
                </a>

                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalActionsCommandeStudio{{ $commandeStudio->id }}">
                    Actions
                </button>
            </div>
        </div>

    </div>

    @include('back.chambre-studio.commandes._modales', ['commandeStudio' => $commandeStudio])
</div>