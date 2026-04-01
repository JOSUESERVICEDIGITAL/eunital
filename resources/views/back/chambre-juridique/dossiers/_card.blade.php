<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="fw-bold mb-1">{{ $dossier->titre }}</h6>
                <small class="text-muted">{{ ucfirst(str_replace('_', ' ', $dossier->type_dossier)) }}</small>
            </div>

            @php
                $statusBadge = match($dossier->statut) {
                    'ouvert' => 'secondary',
                    'en_cours' => 'warning',
                    'ferme' => 'success',
                    'archive' => 'dark',
                    default => 'secondary'
                };
            @endphp

            <span class="badge text-bg-{{ $statusBadge }}">
                {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
            </span>
        </div>

        <div class="small text-muted mb-3">
            {{ $dossier->description ? \Illuminate\Support\Str::limit($dossier->description, 100) : 'Sans description.' }}
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="small text-muted">{{ $dossier->client->nom ?? '—' }}</span>

            <button type="button"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalActionsDossier{{ $dossier->id }}">
                Actions
            </button>
        </div>
    </div>
</div>

@include('back.chambre-juridique.dossiers._modales', ['dossier' => $dossier])
