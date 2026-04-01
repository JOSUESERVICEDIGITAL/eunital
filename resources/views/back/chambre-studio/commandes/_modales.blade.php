<div class="modal fade" id="modalActionsCommandeStudio{{ $commandeStudio->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre de traitement commande · {{ $commandeStudio->titre }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        Workflow : validation, suivi d’exécution et livraison client.
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    <div class="col-md-6 col-xl-4">
                        <div class="content-card h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stat-icon bg-warning-subtle text-warning">
                                    <i class="fa-solid fa-hourglass-half"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Workflow</div>
                                    <div class="fw-bold">Actions métier</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-studio.commandes.valider', $commandeStudio) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-primary rounded-pill w-100">Valider / lancer</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-studio.commandes.livrer', $commandeStudio) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Marquer livrée</button>
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
                                <a href="{{ route('back.chambre-studio.commandes.details', $commandeStudio) }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir la fiche complète
                                </a>

                                <a href="{{ route('back.chambre-studio.clients.tous') }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Voir clients studio
                                </a>

                                <a href="{{ route('back.chambre-studio.dashboard') }}"
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
                                    <div class="mini-label">Suppression</div>
                                    <div class="fw-bold">Gestion de la commande</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST"
                                      action="{{ route('back.chambre-studio.commandes.delete', $commandeStudio) }}"
                                      onsubmit="return confirm('Supprimer cette commande studio ?')">
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