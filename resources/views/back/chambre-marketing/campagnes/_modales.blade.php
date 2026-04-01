{{-- ================= MODALE ACTIONS CAMPAGNE ================= --}}
<div class="modal fade" id="modalActionsCampagne{{ $campagne->id ?? $campagneMarketing->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre de commandes · {{ $campagne->titre ?? $campagneMarketing->titre }}
                    </h5>
                    <p class="text-muted mb-0 small">Pilotage rapide de la diffusion, du budget, du ciblage et de l’organisation.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    {{-- Fenêtre 1 --}}
                    <div class="col-md-6 col-xl-4">
                        <div class="popup-window-card">
                            <div class="popup-window-head">
                                <i class="fa-solid fa-tower-broadcast"></i>
                                <span>Diffusion publicitaire</span>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.activer', $campagne ?? $campagneMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Activer la pub</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.mettre_en_pause', $campagne ?? $campagneMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning rounded-pill w-100">Mettre en pause</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.reprendre', $campagne ?? $campagneMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-info rounded-pill w-100">Relancer</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.terminer', $campagne ?? $campagneMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-secondary rounded-pill w-100">Clôturer</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Fenêtre 2 --}}
                    <div class="col-md-6 col-xl-4">
                        <div class="popup-window-card">
                            <div class="popup-window-head">
                                <i class="fa-solid fa-wallet"></i>
                                <span>Budget & intensité</span>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.augmenter_budget', $campagne ?? $campagneMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-primary rounded-pill w-100">Augmenter le budget</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.diminuer_budget', $campagne ?? $campagneMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-primary rounded-pill w-100">Diminuer le budget</button>
                                </form>

                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre ciblage
                                </button>

                                <button type="button" class="btn btn-outline-dark rounded-pill w-100">
                                    Ouvrir fenêtre créatifs
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Fenêtre 3 --}}
                    <div class="col-md-6 col-xl-4">
                        <div class="popup-window-card">
                            <div class="popup-window-head">
                                <i class="fa-solid fa-sitemap"></i>
                                <span>Organisation campagne</span>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.dupliquer', $campagne ?? $campagneMarketing) }}">
                                    @csrf
                                    <button class="btn btn-dark rounded-pill w-100">Dupliquer la campagne</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.archiver', $campagne ?? $campagneMarketing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-secondary rounded-pill w-100">Archiver</button>
                                </form>

                                <a href="{{ route('back.chambre-marketing.campagnes.details', $campagne ?? $campagneMarketing) }}"
                                   class="btn btn-light border rounded-pill w-100">
                                    Voir le détail complet
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODALE SUPPRESSION ================= --}}
<div class="modal fade" id="modalSuppressionCampagne{{ $campagne->id ?? $campagneMarketing->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Suppression de campagne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Vous êtes sur le point de supprimer
                <strong>{{ $campagne->titre ?? $campagneMarketing->titre }}</strong>.
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                <form method="POST" action="{{ route('back.chambre-marketing.campagnes.supprimer', $campagne ?? $campagneMarketing) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .popup-window-card{
        border:1px solid #e5e7eb;
        border-radius:20px;
        padding:20px;
        background:#f8fafc;
        height:100%;
    }
    .popup-window-head{
        display:flex;
        align-items:center;
        gap:10px;
        margin-bottom:16px;
        font-weight:700;
        color:#0f172a;
    }
    .popup-window-head i{
        width:36px;
        height:36px;
        border-radius:12px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:#eef2f7;
    }
</style>

