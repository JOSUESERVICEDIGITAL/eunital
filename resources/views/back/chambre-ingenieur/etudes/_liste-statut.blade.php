<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.chambre-ingenieur.etudes.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="row g-4">
        @forelse($etudes as $etude)
            <div class="col-lg-6">
                <div class="hub-card">
                    <h5 class="fw-bold">{{ $etude->titre }}</h5>
                    <p class="text-muted small">{{ \Illuminate\Support\Str::limit($etude->description, 120) }}</p>
                    <span class="badge rounded-pill text-bg-light border">{{ ucfirst($etude->decision) }}</span>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">Aucune étude trouvée.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $etudes->links() }}</div>
</div>