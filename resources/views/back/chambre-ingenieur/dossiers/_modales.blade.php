<div class="modal fade" id="modalSuppressionDossier{{ $dossier->id ?? $dossierTechnique->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Suppression du dossier technique</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Vous êtes sur le point de supprimer le dossier technique
                <strong>{{ $dossier->titre ?? $dossierTechnique->titre }}</strong>.
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                <form method="POST" action="{{ route('back.chambre-ingenieur.dossiers.supprimer', $dossier ?? $dossierTechnique) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalSuppressionDocumentPrincipal{{ $dossier->id ?? $dossierTechnique->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-warning">Suppression du document principal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Voulez-vous vraiment supprimer le document principal du dossier
                <strong>{{ $dossier->titre ?? $dossierTechnique->titre }}</strong> ?
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                <form method="POST" action="{{ route('back.chambre-ingenieur.dossiers.supprimer_document_principal', $dossier ?? $dossierTechnique) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning rounded-pill px-4">Supprimer le document</button>
                </form>
            </div>
        </div>
    </div>
</div>