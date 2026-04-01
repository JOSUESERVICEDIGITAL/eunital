<div class="modal fade" id="modalActionsEvenement{{ $evenement->id ?? $evenementStudio->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header">
                <h5 class="modal-title">
                    Actions événement {{ $evenement->titre ?? $evenementStudio->titre }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="d-grid gap-2">

                    <form method="POST" action="{{ route('back.chambre-studio.evenements.marquer_realise', $evenement ?? $evenementStudio) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success w-100">
                            Marquer comme réalisé
                        </button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-studio.evenements.annuler', $evenement ?? $evenementStudio) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning w-100">
                            Annuler l’événement
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('back.chambre-studio.evenements.supprimer', $evenement ?? $evenementStudio) }}"
                          onsubmit="return confirm('Supprimer cet événement ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            Supprimer définitivement
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>