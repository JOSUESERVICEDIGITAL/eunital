@extends('back.layouts.principal')

@section('title', 'Permissions du rôle')
@section('page_title', 'Permissions du rôle')
@section('page_subtitle', 'Attribue ou retire les permissions liées à ce rôle.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $role->nom }}</h4>
                        <p class="text-muted mb-0">{{ $role->description ?: 'Aucune description.' }}</p>
                    </div>
                    <a href="{{ route('back.roles.details', $role) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
                </div>

                <form method="POST" action="{{ route('back.attributions.role.attribuer_permissions', $role) }}">
                    @csrf
                    @method('PUT')

                    <label for="permissions" class="form-label fw-semibold">Sélection des permissions</label>
                    <select name="permissions[]" id="permissions" multiple class="form-select rounded-4">
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}"
                                @selected($role->permissions->pluck('id')->contains($permission->id))>
                                {{ $permission->nom }} @if($permission->groupe) — {{ $permission->groupe }} @endif
                            </option>
                        @endforeach
                    </select>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Mettre à jour les permissions</button>
                    </div>
                </form>

                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Permissions actuelles</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($role->permissions as $permission)
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 border rounded-pill bg-light">
                                <span>{{ $permission->nom }}</span>
                                <form method="POST" action="{{ route('back.attributions.role.retirer_permission', [$role, $permission]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0">retirer</button>
                                </form>
                            </div>
                        @empty
                            <span class="text-muted">Aucune permission attribuée.</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
