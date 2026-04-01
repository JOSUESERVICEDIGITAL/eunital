<div class="modal fade" id="modalSuppressionArticle{{ $article->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Suppression d’article
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <div class="modal-body pt-2">
                <div class="alert alert-light border rounded-4">
                    Vous êtes sur le point de supprimer l’article
                    <strong>{{ $article->titre }}</strong>.
                </div>

                <p class="text-muted mb-0">
                    Cette action retirera définitivement cet article de la chambre éditoriale.
                </p>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                    Annuler
                </button>

                <form method="POST" action="{{ route('back.articles.supprimer', $article) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                        <i class="fa-solid fa-trash me-2"></i>Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>