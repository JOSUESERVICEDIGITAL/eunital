<div class="modal fade" id="modalActionsCreation{{ $creation->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre de traitement graphique · {{ $creation->titre }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        Actions rapides sur la création, son workflow et sa livraison.
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    <div class="col-md-6 col-xl-4">
                        <div class="content-card h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stat-icon bg-info-subtle text-info">
                                    <i class="fa-solid fa-check-double"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Workflow</div>
                                    <div class="fw-bold">Actions métier</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-graphisme.creations.envoyer_en_validation', $creation) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-info rounded-pill w-100">Envoyer en validation</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-graphisme.creations.livrer', $creation) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Marquer livrée</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-graphisme.creations.archiver', $creation) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-dark rounded-pill w-100">Archiver</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="content-card h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stat-icon bg-primary-subtle text-primary">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Navigation</div>
                                    <div class="fw-bold">Accès rapide</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-graphisme.creations.details', $creation) }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir la fiche complète
                                </a>

                                <a href="{{ route('back.chambre-graphisme.dashboard') }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Retour dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xl-4">
                        <div class="content-card h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stat-icon bg-danger-subtle text-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Gestion</div>
                                    <div class="fw-bold">Modification & suppression</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-graphisme.creations.modifier', $creation) }}"
                                   class="btn btn-primary rounded-pill w-100">
                                    Modifier la création
                                </a>

                                <form method="POST"
                                      action="{{ route('back.chambre-graphisme.creations.delete', $creation) }}"
                                      onsubmit="return confirm('Supprimer cette création graphique ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill w-100">
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
</div>