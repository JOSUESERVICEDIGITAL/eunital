<div class="modal fade" id="modalSuppressionArchitecture{{ $architecture->id ?? $architectureTechnique->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Suppression de l’architecture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Vous êtes sur le point de supprimer l’architecture technique
                <strong>{{ $architecture->titre ?? $architectureTechnique->titre }}</strong>.
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                <form method="POST" action="{{ route('back.chambre-ingenieur.architectures.supprimer', $architecture ?? $architectureTechnique) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalSuppressionDiagramme{{ $architecture->id ?? $architectureTechnique->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-warning">Suppression du diagramme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Voulez-vous vraiment supprimer le diagramme associé à
                <strong>{{ $architecture->titre ?? $architectureTechnique->titre }}</strong> ?
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                <form method="POST" action="{{ route('back.chambre-ingenieur.architectures.supprimer_diagramme', $architecture ?? $architectureTechnique) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning rounded-pill px-4">Supprimer le diagramme</button>
                </form>
            </div>
        </div>
    </div>
</div>