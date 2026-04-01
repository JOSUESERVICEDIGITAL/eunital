@extends('back.layouts.principal')

@section('title', 'Attribution des rôles')
@section('page_title', 'Rôles de l’utilisateur')
@section('page_subtitle', 'Attribue ou retire les rôles de cet utilisateur.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $utilisateur->name }}</h4>
                        <p class="text-muted mb-0">{{ $utilisateur->email }}</p>
                    </div>
                    <a href="{{ route('back.utilisateurs.details', $utilisateur) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
                </div>

                <form method="POST" action="{{ route('back.attributions.utilisateur.attribuer_roles', $utilisateur) }}">
                    @csrf
                    @method('PUT')

                    <label for="roles" class="form-label fw-semibold">Sélection des rôles</label>
                    <select name="roles[]" id="roles" multiple class="form-select rounded-4">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                @selected($utilisateur->roles->pluck('id')->contains($role->id))>
                                {{ $role->nom }}
                            </option>
                        @endforeach
                    </select>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Mettre à jour les rôles</button>
                    </div>
                </form>

                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Rôles actuels</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($utilisateur->roles as $role)
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 border rounded-pill bg-light">
                                <span>{{ $role->nom }}</span>
                                <form method="POST" action="{{ route('back.attributions.utilisateur.retirer_role', [$utilisateur, $role]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0">retirer</button>
                                </form>
                            </div>
                        @empty
                            <span class="text-muted">Aucun rôle attribué.</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
