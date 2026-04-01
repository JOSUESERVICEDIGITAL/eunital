<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="fw-bold mb-1">{{ $document->titre }}</h6>
                <small class="text-muted">{{ ucfirst(str_replace('_', ' ', $document->categorie)) }}</small>
            </div>

            @php
                $badge = match($document->statut) {
                    'brouillon' => 'secondary',
                    'actif' => 'success',
                    'archive' => 'dark',
                    default => 'secondary'
                };
            @endphp

            <span class="badge text-bg-{{ $badge }}">
                {{ ucfirst($document->statut) }}
            </span>
        </div>

        <div class="small text-muted mb-3">
            {{ $document->contenu ? \Illuminate\Support\Str::limit(strip_tags($document->contenu), 100) : 'Sans contenu.' }}
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="small text-muted">{{ $document->auteur->name ?? '—' }}</span>

            <button type="button"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalActionsDocument{{ $document->id }}">
                Actions
            </button>
        </div>
    </div>
</div>

@include('back.chambre-juridique.documents._modales', ['document' => $document])
