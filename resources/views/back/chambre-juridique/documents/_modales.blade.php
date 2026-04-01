<div class="modal fade" id="modalActionsDocument{{ $document->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">{{ $document->titre }}</h5>
                    <small class="text-muted">Centre d’actions documentaires</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 h-100">
                            <h6 class="fw-bold">Statut documentaire</h6>
                            <div class="d-grid gap-2 mt-3">
                                <form method="POST" action="{{ route('back.chambre-juridique.documents.activer', $document) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Activer</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-juridique.documents.archiver', $document) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-dark rounded-pill w-100">Archiver</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 h-100">
                            <h6 class="fw-bold">Navigation rapide</h6>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('back.chambre-juridique.documents.details', $document) }}"
                                   class="btn btn-outline-dark rounded-pill">
                                    Ouvrir la fiche complète
                                </a>

                                <a href="{{ route('back.chambre-juridique.documents.modifier', $document) }}"
                                   class="btn btn-outline-primary rounded-pill">
                                    Modifier ce document
                                </a>

                                @if($document->fichier)
                                    <a href="{{ asset('storage/' . $document->fichier) }}"
                                       target="_blank"
                                       class="btn btn-outline-secondary rounded-pill">
                                        Télécharger le fichier
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="border rounded-4 p-3">
                            <h6 class="fw-bold text-danger">Suppression</h6>
                            <form method="POST"
                                  action="{{ route('back.chambre-juridique.documents.delete', $document) }}"
                                  onsubmit="return confirm('Supprimer ce document ?')">
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
