<div class="btn-group btn-group-sm">
    @if(isset($showRoute))<a href="{{ $showRoute }}" class="btn btn-info" title="Voir"><i class="fas fa-eye"></i></a>@endif
    @if(isset($editRoute))<a href="{{ $editRoute }}" class="btn btn-warning" title="Modifier"><i class="fas fa-edit"></i></a>@endif
    @if(isset($deleteRoute))
    <form action="{{ $deleteRoute }}" method="POST" class="d-inline delete-form">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger delete-btn" title="Supprimer"><i class="fas fa-trash"></i></button>
    </form>
    @endif
    @if(isset($customActions)){!! $customActions !!}@endif
</div>