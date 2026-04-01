@extends('back.layouts.principal')

@section('title', 'Permissions')
@section('page_title', 'Gestion des permissions')
@section('page_subtitle', 'Contrôle fin des accès et capacités attribuables aux rôles.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h4 class="fw-bold mb-1">Liste des permissions</h4>
                <p class="text-muted mb-0">Vue globale des permissions disponibles.</p>
            </div>

            <a href="{{ route('back.permissions.creer') }}" class="btn btn-primary rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i>Créer une permission
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Permission</th>
                        <th>Groupe</th>
                        <th>Rôles liés</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>
                                <div class="fw-bold">{{ $permission->nom }}</div>
                                <div class="text-muted small">{{ $permission->slug }}</div>
                            </td>
                            <td>
                                <span class="badge rounded-pill text-bg-light border">{{ $permission->groupe ?: 'Sans groupe' }}</span>
                            </td>
                            <td>
                                <span class="badge rounded-pill text-bg-dark">{{ $permission->roles_count }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('back.permissions.details', $permission) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                <a href="{{ route('back.permissions.modifier', $permission) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal" data-bs-target="#modalSuppressionPermission{{ $permission->id }}">
                                    Supprimer
                                </button>

                                @include('back.utilisateurs.permissions._modales', ['permission' => $permission])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Aucune permission trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $permissions->links() }}
        </div>
    </div>
@endsection
