<div class="modal fade" id="modalSuppressionCommentaire{{ $commentaire->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Suppression de commentaire
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <div class="modal-body pt-2">
                <div class="alert alert-light border rounded-4">
                    Vous êtes sur le point de supprimer le commentaire
                    <strong>#{{ $commentaire->id }}</strong>.
                </div>

                <p class="text-muted mb-0">
                    Cette action supprimera aussi les éventuelles réponses liées si elles existent.
                </p>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                    Annuler
                </button>

                <form method="POST" action="{{ route('back.commentaires.supprimer', $commentaire) }}">
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