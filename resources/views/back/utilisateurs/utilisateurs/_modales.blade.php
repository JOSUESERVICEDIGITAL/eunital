{{-- Modal actions utilisateur --}}
<div class="modal fade" id="modalActionsUtilisateur{{ $utilisateur->id }}" tabindex="-1" aria-labelledby="modalActionsUtilisateurLabel{{ $utilisateur->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalActionsUtilisateurLabel{{ $utilisateur->id }}">
                    Actions utilisateur
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <div class="modal-body pt-3">
                <div class="d-grid gap-2">

                    <a href="{{ route('back.utilisateurs.details', $utilisateur) }}"
                       class="btn btn-light text-start rounded-3">
                        <i class="fa-solid fa-eye me-2 text-primary"></i> Voir
                    </a>

                    <a href="{{ route('back.utilisateurs.modifier', $utilisateur) }}"
                       class="btn btn-light text-start rounded-3">
                        <i class="fa-solid fa-pen me-2 text-warning"></i> Modifier
                    </a>

                    <a href="{{ route('back.attributions.utilisateur.roles', $utilisateur) }}"
                       class="btn btn-light text-start rounded-3">
                        <i class="fa-solid fa-user-gear me-2 text-dark"></i> Rôles
                    </a>

                    @if(!$utilisateur->est_actif)
                        <form method="POST" action="{{ route('back.utilisateurs.activer', $utilisateur) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-light text-start rounded-3 w-100">
                                <i class="fa-solid fa-check me-2 text-success"></i> Activer
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('back.utilisateurs.desactiver', $utilisateur) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-light text-start rounded-3 w-100">
                                <i class="fa-solid fa-ban me-2 text-secondary"></i> Désactiver
                            </button>
                        </form>
                    @endif

                    @if($utilisateur->statut_compte !== 'suspendu')
                        <form method="POST" action="{{ route('back.utilisateurs.suspendre', $utilisateur) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-light text-start rounded-3 w-100">
                                <i class="fa-solid fa-user-lock me-2 text-danger"></i> Suspendre
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('back.utilisateurs.retablir', $utilisateur) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-light text-start rounded-3 w-100">
                                <i class="fa-solid fa-rotate-left me-2 text-success"></i> Rétablir
                            </button>
                        </form>
                    @endif

                    <button type="button"
                            class="btn btn-light text-start rounded-3 w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#modalSuppressionUtilisateur{{ $utilisateur->id }}">
                        <i class="fa-solid fa-trash me-2 text-danger"></i> Supprimer
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>