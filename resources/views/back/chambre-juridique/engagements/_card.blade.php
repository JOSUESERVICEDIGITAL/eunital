<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="fw-bold mb-1">{{ $engagement->nom_complet }}</h6>
                <small class="text-muted">{{ ucfirst($engagement->type_engagement) }}</small>
            </div>

            @php
                $badge = match($engagement->statut) {
                    'en_attente' => 'secondary',
                    'en_etude' => 'warning',
                    'valide' => 'success',
                    'rejete' => 'danger',
                    'archive' => 'dark',
                    default => 'secondary'
                };
            @endphp

            <span class="badge text-bg-{{ $badge }}">
                {{ ucfirst(str_replace('_', ' ', $engagement->statut)) }}
            </span>
        </div>

        <div class="small text-muted mb-3">
            {{ $engagement->description ? \Illuminate\Support\Str::limit($engagement->description, 90) : 'Aucune description' }}
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('back.chambre-juridique.engagements.details', $engagement) }}"
               class="btn btn-sm btn-outline-dark rounded-pill px-3">
                Voir
            </a>

            <button type="button"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalActionsEngagement{{ $engagement->id }}">
                Actions
            </button>
        </div>
    </div>
</div>

@include('back.chambre-juridique.engagements._modales', ['engagement' => $engagement])
