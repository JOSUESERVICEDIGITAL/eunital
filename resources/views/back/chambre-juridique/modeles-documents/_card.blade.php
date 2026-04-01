<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="fw-bold mb-1">{{ $modele->nom }}</h6>
                <small class="text-muted">{{ ucfirst(str_replace('_', ' ', $modele->type_document)) }}</small>
            </div>

            <span class="badge text-bg-{{ $modele->actif ? 'success' : 'secondary' }}">
                {{ $modele->actif ? 'Actif' : 'Inactif' }}
            </span>
        </div>

        <div class="small text-muted mb-3">
            {{ $modele->contenu ? \Illuminate\Support\Str::limit(strip_tags($modele->contenu), 100) : 'Sans contenu.' }}
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="small text-muted">Version : {{ $modele->version ?? '—' }}</span>

            <button type="button"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalActionsModele{{ $modele->id }}">
                Actions
            </button>
        </div>
    </div>
</div>

@include('back.chambre-juridique.modeles-documents._modales', ['modele' => $modele])
