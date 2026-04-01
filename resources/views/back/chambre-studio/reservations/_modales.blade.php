<div class="modal fade" id="modalActionsReservationStudio{{ $reservationStudio->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        Centre de traitement réservation · {{ $reservationStudio->client->nom ?? 'Client studio' }}
                    </h5>
                    <p class="text-muted mb-0 small">
                        Workflow : réservation, confirmation, annulation et gestion planning.
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    <div class="col-md-6 col-xl-4">
                        <div class="content-card h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stat-icon bg-success-subtle text-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Workflow</div>
                                    <div class="fw-bold">Actions métier</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('back.chambre-studio.reservations.confirmer', $reservationStudio) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success rounded-pill w-100">Confirmer</button>
                                </form>

                                <form method="POST" action="{{ route('back.chambre-studio.reservations.annuler', $reservationStudio) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger rounded-pill w-100">Annuler</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="content-card h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stat-icon bg-primary-subtle text-primary">
                                    <i class="fa-solid fa-calendar-day"></i>
                                </div>
                                <div>
                                    <div class="mini-label">Navigation</div>
                                    <div class="fw-bold">Accès rapide</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('back.chambre-studio.reservations.details', $reservationStudio) }}"
                                   class="btn btn-outline-secondary rounded-pill w-100">
                                    Ouvrir la fiche complète
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
                                    <div class="fw-bold">Gestion réservation</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <form method="POST"
                                      action="{{ route('back.chambre-studio.reservations.delete', $reservationStudio) }}"
                                      onsubmit="return confirm('Supprimer cette réservation studio ?')">
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