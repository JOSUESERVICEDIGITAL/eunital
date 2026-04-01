<div class="modal fade" id="modalActionsVideo{{ $video->id ?? $productionVideo->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre de traitement vidéo · {{ $video->titre ?? $productionVideo->titre }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        Workflow studio : tournage, montage, validation, livraison et archivage.
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    {{-- WORKFLOW --}}
                    <div class="col-md-6 col-xl-4">
                        <div class="video-action-card">
                            <div class="video-action-head">
                                <i class="fa-solid fa-film"></i>
                                <span>Workflow vidéo</span>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-studio.productions-video.livrer', $video ?? $productionVideo) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success w-100 rounded-pill">
                                        Marquer comme livrée
                                    </button>
                                </form>
                            </div>

                            <div class="mt-3 small text-muted">
                                Les étapes intermédiaires tournage, montage et validation sont gérées depuis
                                le formulaire d’édition ou les vues filtrées du pipeline.
                            </div>
                        </div>
                    </div>

                    {{-- FENÊTRES STUDIO --}}
                    <div class="col-md-6 col-xl-4">
                        <div class="video-action-card">
                            <div class="video-action-head">
                                <i class="fa-solid fa-camera-retro"></i>
                                <span>Fenêtres studio</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-studio.productions-video.details', $video ?? $productionVideo) }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir fiche complète
                                </a>

                                <a href="{{ route('back.chambre-studio.montages.tous') }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir pipeline montage
                                </a>

                                <a href="{{ route('back.chambre-studio.commandes.toutes') }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir commandes client
                                </a>

                                <a href="{{ route('back.chambre-studio.dashboard') }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Retour dashboard studio
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- NAVIGATION & SUPPRESSION --}}
                    <div class="col-md-12 col-xl-4">
                        <div class="video-action-card">
                            <div class="video-action-head">
                                <i class="fa-solid fa-folder-open"></i>
                                <span>Navigation & suppression</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-studio.productions-video.details', $video ?? $productionVideo) }}"
                                   class="btn btn-light border rounded-pill w-100">
                                    Voir la fiche complète
                                </a>

                                <a href="{{ route('back.chambre-studio.productions-video.modifier', $video ?? $productionVideo) }}"
                                   class="btn btn-primary rounded-pill w-100">
                                    Modifier la production
                                </a>

                                <form method="POST"
                                      action="{{ route('back.chambre-studio.productions-video.delete', $video ?? $productionVideo) }}"
                                      onsubmit="return confirm('Supprimer cette production vidéo ?')">
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

<style>
    .video-action-card{
        border:1px solid #e5e7eb;
        border-radius:22px;
        padding:20px;
        background:#f8fafc;
        height:100%;
    }

    .video-action-head{
        display:flex;
        align-items:center;
        gap:10px;
        margin-bottom:16px;
        font-weight:700;
        color:#0f172a;
    }

    .video-action-head i{
        width:38px;
        height:38px;
        border-radius:14px;
        background:#fee2e2;
        display:flex;
        align-items:center;
        justify-content:center;
        color:#dc2626;
    }
</style>