@php
    $modalId = $modalId ?? 'tableActionsModal' . uniqid();
@endphp

<div class="text-end">
    <button type="button"
            class="btn btn-light btn-sm rounded-circle"
            data-bs-toggle="modal"
            data-bs-target="#{{ $modalId }}">
        <i class="fas fa-ellipsis-v"></i>
    </button>
</div>

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title">Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <div class="modal-body">
                <div class="d-grid gap-2">

                    @if(isset($showRoute))
                        <a class="btn btn-light text-start rounded-3" href="{{ $showRoute }}">
                            <i class="fas fa-eye me-2 text-info"></i> Voir
                        </a>
                    @endif

                    @if(isset($editRoute))
                        <a class="btn btn-light text-start rounded-3" href="{{ $editRoute }}">
                            <i class="fas fa-edit me-2 text-warning"></i> Modifier
                        </a>
                    @endif

                    @if(isset($inscription))
                        <form action="{{ route('back.formation.inscriptions.valider', $inscription) }}" method="POST" class="valider-form m-0">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-light text-start rounded-3 w-100">
                                <i class="fas fa-check me-2 text-success"></i> Valider
                            </button>
                        </form>
                    @endif

                    @if(isset($deleteRoute))
                        <form action="{{ $deleteRoute }}" method="POST" class="delete-form m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light text-start rounded-3 w-100 text-danger">
                                <i class="fas fa-trash me-2"></i> Supprimer
                            </button>
                        </form>
                    @endif

                    @if(isset($customActions))
                        {!! $customActions !!}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
