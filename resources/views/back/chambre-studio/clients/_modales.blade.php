<div class="modal fade" id="modalActionsClientStudio{{ $clientStudio->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre client studio · {{ $clientStudio->nom }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        Consultation rapide du client et gestion de sa fiche.
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="content-card h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stat-icon bg-primary-subtle text-primary">
                                    <i class="fa-solid fa-address-card"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Navigation</div>
                                    <div class="fw-bold">Accès rapide</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-studio.clients.details', $clientStudio) }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir la fiche complète
                                </a>

                                <a href="{{ route('back.chambre-studio.commandes.toutes') }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Voir commandes studio
                                </a>

                                <a href="{{ route('back.chambre-studio.dashboard') }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Retour dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stat-icon bg-danger-subtle text-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Suppression</div>
                                    <div class="fw-bold">Gestion de la fiche</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST"
                                      action="{{ route('back.chambre-studio.clients.delete', $clientStudio) }}"
                                      onsubmit="return confirm('Supprimer ce client studio ?')">
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