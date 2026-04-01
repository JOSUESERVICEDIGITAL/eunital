<div class="modal fade" id="modalActionsAudio{{ $audio->id ?? $productionAudio->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre de traitement audio · {{ $audio->titre ?? $productionAudio->titre }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        Workflow studio : enregistrement, mixage, mastering, livraison et archivage.
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
                                    <i class="fa-solid fa-sliders"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Workflow</div>
                                    <div class="fw-bold">Actions métier</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-studio.productions-audio.envoyer_en_mixage', $audio ?? $productionAudio) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning rounded-pill w-100">Envoyer en mixage</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-studio.productions-audio.envoyer_en_mastering', $audio ?? $productionAudio) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-info rounded-pill w-100">Envoyer en mastering</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-studio.productions-audio.livrer', $audio ?? $productionAudio) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Marquer livrée</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-studio.productions-audio.archiver', $audio ?? $productionAudio) }}">
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
                                    <i class="fa-solid fa-headphones"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Fenêtres</div>
                                    <div class="fw-bold">Navigation rapide</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-studio.productions-audio.details', $audio ?? $productionAudio) }}"
                                    class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir fiche complète
                                </a>

                                <a href="{{ route('back.chambre-studio.commandes.toutes') }}"
                                    class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir commandes
                                </a>

                                <a href="{{ route('back.chambre-studio.projets.tous') }}"
                                    class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir projets studio
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
                                    <div class="mini-label">Gestion</div>
                                    <div class="fw-bold">Modification & suppression</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-studio.productions-audio.modifier', $audio ?? $productionAudio) }}"
                                    class="btn btn-primary rounded-pill w-100">
                                    Modifier la session
                                </a>

                                <form method="POST"
                                    action="{{ route('back.chambre-studio.productions-audio.delete', $audio ?? $productionAudio) }}"
                                    onsubmit="return confirm('Supprimer cette production audio ?')">
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