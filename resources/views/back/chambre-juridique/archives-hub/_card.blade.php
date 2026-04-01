<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="fw-bold mb-1">{{ $archive->titre }}</h6>
                <small class="text-muted">{{ ucfirst(str_replace('_', ' ', $archive->categorie)) }}</small>
            </div>

            <span class="badge text-bg-{{ $archive->visible ? 'success' : 'secondary' }}">
                {{ $archive->visible ? 'Visible' : 'Masquée' }}
            </span>
        </div>

        <div class="small text-muted mb-3">
            {{ $archive->description ? \Illuminate\Support\Str::limit($archive->description, 100) : 'Sans description.' }}
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="small text-muted">{{ ucfirst($archive->type_fichier) }}</span>

            <button type="button"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalActionsArchive{{ $archive->id }}">
                Actions
            </button>
        </div>
    </div>
</div>

@include('back.chambre-juridique.archives-hub._modales', ['archive' => $archive])