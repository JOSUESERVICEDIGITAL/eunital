<div class="modal fade" id="modalSuppressionEtude{{ $etude->id ?? $etudeFaisabilite->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Suppression de l’étude</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Vous êtes sur le point de supprimer l’étude de faisabilité
                <strong>{{ $etude->titre ?? $etudeFaisabilite->titre }}</strong>.
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                <form method="POST" action="{{ route('back.chambre-ingenieur.etudes.supprimer', $etude ?? $etudeFaisabilite) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>