@extends('back.formation.layouts.app')

@section('title', 'Modules de formation')
@section('page_title', 'Gestion des modules')
@section('page_subtitle', 'Liste et organisation des modules de formation par catégorie')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-folder-open mr-2"></i>
            Modules de formation
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.modules.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouveau module
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Niveau</th>
                        <th style="width: 80px">Cours</th>
                        <th style="width: 80px">Inscrits</th>
                        <th style="width: 100px">Statut</th>
                        <th style="width: 120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($modules as $module)
                    <tr>
                        <td>{{ $module->id }}</td>
                        <td>
                            <strong>{{ $module->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($module->description, 50) }}</small>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $module->categorie->nom ?? 'N/A' }}</span>
                        </td>
                        <td>
                            @include('back.formation.partials.status-badge', ['status' => $module->niveau])
                        </td>
                        <td>
                            <span class="badge badge-primary">{{ $module->cours_count }}</span>
                        </td>
                        <td>
                            <span class="badge badge-success">{{ $module->inscriptions_count }}</span>
                        </td>
                        <td>
                            @include('back.formation.partials.status-badge', ['status' => $module->is_active ? 'active' : 'inactive'])
                        </td>
                        <td>
                            @include('back.formation.partials.table-actions', [
                                'showRoute' => route('back.formation.modules.show', $module),
                                'editRoute' => route('back.formation.modules.edit', $module),
                                'deleteRoute' => route('back.formation.modules.destroy', $module),
                                'customActions' => '
                                    <button type="button" class="btn btn-sm btn-info" onclick="toggleActive(' . $module->id . ', ' . ($module->is_active ? 'false' : 'true') . ')" title="' . ($module->is_active ? 'Désactiver' : 'Activer') . '">
                                        <i class="fas fa-' . ($module->is_active ? 'ban' : 'check-circle') . '"></i>
                                    </button>
                                '
                            ])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                            Aucun module trouvé
                            <br>
                            <a href="{{ route('back.formation.modules.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Créer le premier module
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Affichage de {{ $modules->firstItem() ?? 0 }} à {{ $modules->lastItem() ?? 0 }} sur {{ $modules->total() }} modules
            </div>
            @include('back.formation.partials.pagination', ['items' => $modules])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.modules.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les modules</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Catégorie</label>
                        <select name="categorie" class="form-control">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories ?? [] as $categorie)
                            <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Niveau</label>
                        <select name="niveau" class="form-control">
                            <option value="">Tous les niveaux</option>
                            <option value="debutant" {{ request('niveau') == 'debutant' ? 'selected' : '' }}>Débutant</option>
                            <option value="intermediaire" {{ request('niveau') == 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                            <option value="avance" {{ request('niveau') == 'avance' ? 'selected' : '' }}>Avancé</option>
                            <option value="expert" {{ request('niveau') == 'expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="statut" class="form-control">
                            <option value="">Tous</option>
                            <option value="active" {{ request('statut') == 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="inactive" {{ request('statut') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.modules.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleActive(id, isActive) {
        $.ajax({
            url: '/back/formation/modules/' + id + '/toggle-active',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PATCH'
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            }
        });
    }
</script>
@endpush