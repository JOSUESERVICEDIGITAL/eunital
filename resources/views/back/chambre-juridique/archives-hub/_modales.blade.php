<div class="modal fade" id="modalActionsArchive{{ $archive->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">{{ $archive->titre }}</h5>
                    <small class="text-muted">Centre d’actions archive</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 h-100">
                            <h6 class="fw-bold">Visibilité</h6>
                            <div class="d-grid gap-2 mt-3">
                                <form method="POST" action="{{ route('back.chambre-juridique.archives-hub.rendre_visible', $archive) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Rendre visible</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-juridique.archives-hub.masquer', $archive) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-secondary rounded-pill w-100">Masquer</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 h-100">
                            <h6 class="fw-bold">Navigation rapide</h6>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('back.chambre-juridique.archives-hub.details', $archive) }}"
                                   class="btn btn-outline-dark rounded-pill">
                                    Ouvrir la fiche complète
                                </a>

                                <a href="{{ route('back.chambre-juridique.archives-hub.modifier', $archive) }}"
                                   class="btn btn-outline-primary rounded-pill">
                                    Modifier cette archive
                                </a>

                                @if($archive->fichier)
                                    <a href="{{ asset('storage/' . $archive->fichier) }}"
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
                                  action="{{ route('back.chambre-juridique.archives-hub.delete', $archive) }}"
                                  onsubmit="return confirm('Supprimer cette archive ?')">
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