<div class="dropdown">
    <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow-sm">

        @if(isset($showRoute))
            <li>
                <a class="dropdown-item" href="{{ $showRoute }}">
                    <i class="fas fa-eye me-2 text-info"></i> Voir
                </a>
            </li>
        @endif

        @if(isset($editRoute))
            <li>
                <a class="dropdown-item" href="{{ $editRoute }}">
                    <i class="fas fa-edit me-2 text-warning"></i> Modifier
                </a>
            </li>
        @endif

        @if(isset($inscription))
            <li>
                <form action="{{ route('back.formation.inscriptions.valider', $inscription) }}" method="POST" class="valider-form">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-check me-2 text-success"></i> Valider
                    </button>
                </form>
            </li>
        @endif

        @if(isset($deleteRoute))
            <li>
                <form action="{{ $deleteRoute }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-trash me-2"></i> Supprimer
                    </button>
                </form>
            </li>
        @endif

        @if(isset($customActions))
            <li><hr class="dropdown-divider"></li>
            {!! $customActions !!}
        @endif

    </ul>
</div>