<div class="modal fade" id="modalActionsPiece{{ $piece->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">{{ $piece->titre }}</h5>
                    <small class="text-muted">Centre d’actions pièce jointe</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 h-100">
                            <h6 class="fw-bold">Navigation rapide</h6>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('back.chambre-juridique.pieces-jointes.details', $piece) }}"
                                   class="btn btn-outline-dark rounded-pill">
                                    Ouvrir la fiche complète
                                </a>

                                <a href="{{ route('back.chambre-juridique.pieces-jointes.modifier', $piece) }}"
                                   class="btn btn-outline-primary rounded-pill">
                                    Modifier cette pièce
                                </a>

                                @if($piece->fichier)
                                    <a href="{{ asset('storage/' . $piece->fichier) }}"
                                       target="_blank"
                                       class="btn btn-outline-secondary rounded-pill">
                                        Télécharger le fichier
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 h-100">
                            <h6 class="fw-bold">Liaisons détectées</h6>
                            <div class="small text-muted mt-2">
                                Contrat : <strong>{{ $piece->contrat?->titre ?? '—' }}</strong><br>
                                Engagement : <strong>{{ $piece->engagement?->nom_complet ?? '—' }}</strong><br>
                                Dossier : <strong>{{ $piece->dossier?->titre ?? '—' }}</strong><br>
                                Archive : <strong>{{ $piece->archive?->titre ?? '—' }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="border rounded-4 p-3">
                            <h6 class="fw-bold text-danger">Suppression</h6>
                            <form method="POST"
                                  action="{{ route('back.chambre-juridique.pieces-jointes.delete', $piece) }}"
                                  onsubmit="return confirm('Supprimer cette pièce jointe ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger rounded-pill mt-2">
                                    Supprimer définitivement
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>