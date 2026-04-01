<div class="modal fade" id="modalActionsAcquisition{{ $acquisition->id ?? $acquisitionMarketing->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre acquisition · {{ $acquisition->titre ?? $acquisitionMarketing->titre }}
                    </h5>
                    <p class="text-muted mb-0 small">Optimisation du canal, activation, arrêt et pilotage des performances d’entrée.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    <div class="col-md-6 col-xl-4">
                        <div class="popup-window-card">
                            <div class="popup-window-head">
                                <i class="fa-solid fa-bolt"></i>
                                <span>Actions rapides</span>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-marketing.acquisitions.activer', $acquisition ?? $acquisitionMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Activer</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.acquisitions.optimiser', $acquisition ?? $acquisitionMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-primary rounded-pill w-100">Passer en optimisation</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.acquisitions.stopper', $acquisition ?? $acquisitionMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning rounded-pill w-100">Stopper</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.acquisitions.archiver', $acquisition ?? $acquisitionMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-secondary rounded-pill w-100">Archiver</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="popup-window-card">
                            <div class="popup-window-head">
                                <i class="fa-solid fa-chart-simple"></i>
                                <span>Fenêtres analyse</span>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre visiteurs
                                </button>

                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre leads
                                </button>

                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre coût acquisition
                                </button>

                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre canal
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xl-4">
                        <div class="popup-window-card">
                            <div class="popup-window-head">
                                <i class="fa-solid fa-link"></i>
                                <span>Liaison & navigation</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-marketing.acquisitions.details', $acquisition ?? $acquisitionMarketing) }}"
                                   class="btn btn-light border rounded-pill w-100">
                                    Voir le détail complet
                                </a>

                                <a href="{{ route('back.chambre-marketing.acquisitions.modifier', $acquisition ?? $acquisitionMarketing) }}"
                                   class="btn btn-warning rounded-pill w-100">
                                    Modifier
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSuppressionAcquisition{{ $acquisition->id ?? $acquisitionMarketing->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Suppression d’acquisition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Vous êtes sur le point de supprimer
                <strong>{{ $acquisition->titre ?? $acquisitionMarketing->titre }}</strong>.
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                <form method="POST" action="{{ route('back.chambre-marketing.acquisitions.supprimer', $acquisition ?? $acquisitionMarketing) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
