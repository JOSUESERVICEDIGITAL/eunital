<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.chambre-ingenieur.reflexions.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="row g-4">
        @forelse($reflexions as $reflexion)
            <div class="col-md-6 col-xl-4">
                <div class="hub-card">
                    <span class="badge rounded-pill text-bg-light border">{{ ucfirst($reflexion->statut) }}</span>
                    <h5 class="fw-bold mt-3">{{ $reflexion->titre }}</h5>
                    <p class="text-muted small">{{ \Illuminate\Support\Str::limit($reflexion->contexte, 100) }}</p>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">Aucune réflexion trouvée.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $reflexions->links() }}</div>
</div>