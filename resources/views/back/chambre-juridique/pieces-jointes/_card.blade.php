<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="fw-bold mb-1">{{ $piece->titre }}</h6>
                <small class="text-muted">{{ ucfirst(str_replace('_', ' ', $piece->type_piece)) }}</small>
            </div>

            @if($piece->contrat)
                <span class="badge text-bg-primary">Contrat</span>
            @elseif($piece->engagement)
                <span class="badge text-bg-info">Engagement</span>
            @elseif($piece->dossier)
                <span class="badge text-bg-warning">Dossier</span>
            @elseif($piece->archive)
                <span class="badge text-bg-secondary">Archive</span>
            @else
                <span class="badge text-bg-light border text-dark">Non liée</span>
            @endif
        </div>

        <div class="small text-muted mb-3">
            {{ $piece->contrat?->titre ?? $piece->engagement?->nom_complet ?? $piece->dossier?->titre ?? $piece->archive?->titre ?? 'Aucune liaison.' }}
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="small text-muted">{{ $piece->auteur->name ?? '—' }}</span>

            <button type="button"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalActionsPiece{{ $piece->id }}">
                Actions
            </button>
        </div>
    </div>
</div>

@include('back.chambre-juridique.pieces-jointes._modales', ['piece' => $piece])