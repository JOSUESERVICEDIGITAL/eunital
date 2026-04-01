<div class="modal fade" id="modalActionsDossier{{ $dossier->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">{{ $dossier->titre }}</h5>
                    <small class="text-muted">Centre d’actions dossier juridique</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="border rounded-4 p-3 h-100">
                            <h6 class="fw-bold">Statut du dossier</h6>
                            <div class="d-grid gap-2 mt-3">
                                <form method="POST" action="{{ route('back.chambre-juridique.dossiers.ouvrir', $dossier) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-secondary rounded-pill w-100">Réouvrir</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-juridique.dossiers.lancer', $dossier) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning rounded-pill w-100">Passer en cours</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-juridique.dossiers.fermer', $dossier) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Fermer</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-juridique.dossiers.archiver', $dossier) }}">
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
                                <a href="{{ route('back.chambre-juridique.dossiers.details', $dossier) }}"
                                   class="btn btn-outline-dark rounded-pill">
                                    Ouvrir la fiche complète
                                </a>

                                <a href="{{ route('back.chambre-juridique.dossiers.modifier', $dossier) }}"
                                   class="btn btn-outline-primary rounded-pill">
                                    Modifier ce dossier
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="border rounded-4 p-3">
                            <h6 class="fw-bold text-danger">Suppression</h6>
                            <form method="POST"
                                  action="{{ route('back.chambre-juridique.dossiers.delete', $dossier) }}"
                                  onsubmit="return confirm('Supprimer ce dossier ?')">
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
