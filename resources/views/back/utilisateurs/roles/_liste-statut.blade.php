<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <a href="{{ route('back.roles.tous') }}" class="btn btn-outline-dark rounded-pill px-4">
            Retour à tous les rôles
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rôle</th>
                    <th>Utilisateurs</th>
                    <th>Permissions</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $role->nom }}</div>
                            <div class="text-muted small">{{ $role->slug }}</div>
                        </td>
                        <td>{{ $role->utilisateurs_count }}</td>
                        <td>{{ $role->permissions_count }}</td>
                        <td>
                            <span class="badge rounded-pill text-bg-{{ $couleurBadge }}">{{ $texteBadge }}</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('back.roles.details', $role) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                            <a href="{{ route('back.roles.modifier', $role) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Aucun rôle trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $roles->links() }}
    </div>
</div>
