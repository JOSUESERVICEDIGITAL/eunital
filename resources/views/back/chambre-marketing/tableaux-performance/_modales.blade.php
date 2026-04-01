<div class="modal fade" id="modalActionsTableau{{ $tableau->id ?? $tableauPerformanceMarketing->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre analytique · {{ $tableau->titre ?? $tableauPerformanceMarketing->titre }}
                    </h5>
                    <p class="text-muted mb-0 small">Pilotage des KPI, publication, brouillon, archivage et navigation analytique.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    <div class="col-md-6 col-xl-4">
                        <div class="popup-window-card">
                            <div class="popup-window-head">
                                <i class="fa-solid fa-file-waveform"></i>
                                <span>Publication</span>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.publier', $tableau ?? $tableauPerformanceMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Publier</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.remettre_en_brouillon', $tableau ?? $tableauPerformanceMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning rounded-pill w-100">Remettre en brouillon</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.archiver', $tableau ?? $tableauPerformanceMarketing) }}">
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
                                <i class="fa-solid fa-chart-pie"></i>
                                <span>Fenêtres KPI</span>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre conversions
                                </button>

                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre coûts
                                </button>

                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre ROAS
                                </button>

                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre comparaison
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xl-4">
                        <div class="popup-window-card">
                            <div class="popup-window-head">
                                <i class="fa-solid fa-compass"></i>
                                <span>Navigation</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-marketing.tableaux-performance.details', $tableau ?? $tableauPerformanceMarketing) }}"
                                   class="btn btn-light border rounded-pill w-100">
                                    Voir le détail complet
                                </a>

                                <a href="{{ route('back.chambre-marketing.tableaux-performance.modifier', $tableau ?? $tableauPerformanceMarketing) }}"
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

<div class="modal fade" id="modalSuppressionTableau{{ $tableau->id ?? $tableauPerformanceMarketing->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Suppression du tableau</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Vous êtes sur le point de supprimer
                <strong>{{ $tableau->titre ?? $tableauPerformanceMarketing->titre }}</strong>.
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                <form method="POST" action="{{ route('back.chambre-marketing.tableaux-performance.supprimer', $tableau ?? $tableauPerformanceMarketing) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>