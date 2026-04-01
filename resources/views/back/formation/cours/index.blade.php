@extends('back.formation.layouts.app')

@section('title', 'Cours de formation')
@section('page_title', 'Gestion des cours')
@section('page_subtitle', 'Liste et organisation des cours par module')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-book mr-2"></i>
            Tous les cours
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.cours.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouveau cours
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
                        <th>Module</th>
                        <th>Niveau</th>
                        <th style="width: 80px">Chapitres</th>
                        <th style="width: 80px">Étudiants</th>
                        <th style="width: 100px">Statut</th>
                        <th style="width: 120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cours as $cour)
                    <tr>
                        <td>{{ $cour->id }}</td>
                        <td>
                            <strong>{{ $cour->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($cour->description, 50) }}</small>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $cour->module->titre ?? 'N/A' }}</span>
                        </td>
                        <td>
                            @include('back.formation.partials.status-badge', ['status' => $cour->niveau_difficulte])
                        </td>
                        <td>
                            <span class="badge badge-primary">{{ $cour->chapitres_count }}</span>
                        </td>
                        <td>
                            <span class="badge badge-success">{{ $cour->utilisateurs_count }}</span>
                        </td>
                        <td>
                            @include('back.formation.partials.status-badge', ['status' => $cour->is_published ? 'publie' : 'brouillon'])
                        </td>
                        <td>
                            @include('back.formation.partials.table-actions', [
                                'showRoute' => route('back.formation.cours.show', $cour),
                                'editRoute' => route('back.formation.cours.edit', $cour),
                                'deleteRoute' => route('back.formation.cours.destroy', $cour),
                                'customActions' => '
                                    <button type="button" class="btn btn-sm btn-' . ($cour->is_published ? 'warning' : 'success') . '" 
                                            onclick="togglePublish(' . $cour->id . ', ' . ($cour->is_published ? 'false' : 'true') . ')" 
                                            title="' . ($cour->is_published ? 'Dépublier' : 'Publier') . '">
                                        <i class="fas fa-' . ($cour->is_published ? 'eye-slash' : 'eye') . '"></i>
                                    </button>
                                '
                            ])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-book-open fa-3x text-muted mb-3 d-block"></i>
                            Aucun cours trouvé
                            <br>
                            <a href="{{ route('back.formation.cours.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Créer le premier cours
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
                Affichage de {{ $cours->firstItem() ?? 0 }} à {{ $cours->lastItem() ?? 0 }} sur {{ $cours->total() }} cours
            </div>
            @include('back.formation.partials.pagination', ['items' => $cours])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.cours.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les cours</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Module</label>
                        <select name="module_id" class="form-control">
                            <option value="">Tous les modules</option>
                            @foreach($modules ?? [] as $module)
                            <option value="{{ $module->id }}" {{ request('module_id') == $module->id ? 'selected' : '' }}>
                                {{ $module->titre }}
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
                            <option value="publie" {{ request('statut') == 'publie' ? 'selected' : '' }}>Publié</option>
                            <option value="brouillon" {{ request('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.cours.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePublish(id, publish) {
        $.ajax({
            url: '/back/formation/cours/' + id + '/' + (publish ? 'publier' : 'depublier'),
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