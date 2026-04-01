@extends('back.formation.layouts.app')

@section('title', 'Inscriptions')
@section('page_title', 'Gestion des inscriptions')
@section('page_subtitle', 'Liste et suivi des inscriptions aux modules de formation')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users mr-2"></i>
            Toutes les inscriptions
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.inscriptions.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouvelle inscription
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
                        <th>Étudiant</th>
                        <th>Module</th>
                        <th>Date inscription</th>
                        <th>Progression</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscriptions as $inscription)
                    <tr>
                        <td>{{ $inscription->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ substr($inscription->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $inscription->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $inscription->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.modules.show', $inscription->module) }}" class="text-info">
                                {{ $inscription->module->titre }}
                            </a>
                            <br>
                            <small class="text-muted">{{ $inscription->module->categorie->nom ?? 'N/A' }}</small>
                        </td>
                        <td>
                            {{ $inscription->created_at->format('d/m/Y') }}
                            <br>
                            <small class="text-muted">{{ $inscription->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            <div class="progress" style="height: 6px; width: 100px;">
                                <div class="progress-bar bg-primary" style="width: {{ $inscription->progression }}%"></div>
                            </div>
                            <small>{{ $inscription->progression }}%</small>
                        </td>
                        <td>
                            @include('back.formation.partials.status-badge', ['status' => $inscription->statut])
                        </td>
                        <td>
                            @include('back.formation.partials.table-actions', [
                                'showRoute' => route('back.formation.inscriptions.show', $inscription),
                                'editRoute' => route('back.formation.inscriptions.edit', $inscription),
                                'deleteRoute' => route('back.formation.inscriptions.destroy', $inscription),
                                'customActions' => '
                                    <button type="button" class="btn btn-sm btn-success" onclick="validerInscription(' . $inscription->id . ')" title="Valider">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="abandonnerInscription(' . $inscription->id . ')" title="Abandonner">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                '
                            ])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                            Aucune inscription trouvée
                            <br>
                            <a href="{{ route('back.formation.inscriptions.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Créer la première inscription
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
                Affichage de {{ $inscriptions->firstItem() ?? 0 }} à {{ $inscriptions->lastItem() ?? 0 }} sur {{ $inscriptions->total() }} inscriptions
            </div>
            @include('back.formation.partials.pagination', ['items' => $inscriptions])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.inscriptions.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les inscriptions</h5>
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
                        <label>Statut</label>
                        <select name="statut" class="form-control">
                            <option value="">Tous</option>
                            <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="valide" {{ request('statut') == 'valide' ? 'selected' : '' }}>Validé</option>
                            <option value="termine" {{ request('statut') == 'termine' ? 'selected' : '' }}>Terminé</option>
                            <option value="abandonne" {{ request('statut') == 'abandonne' ? 'selected' : '' }}>Abandonné</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date début</label>
                        <input type="date" name="date_debut" class="form-control" value="{{ request('date_debut') }}">
                    </div>
                    <div class="form-group">
                        <label>Date fin</label>
                        <input type="date" name="date_fin" class="form-control" value="{{ request('date_fin') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function validerInscription(id) {
        Swal.fire({
            title: 'Valider l\'inscription',
            text: 'Êtes-vous sûr de vouloir valider cette inscription ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, valider',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/inscriptions/' + id + '/valider',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Validé!', 'L\'inscription a été validée', 'success');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
    
    function abandonnerInscription(id) {
        Swal.fire({
            title: 'Abandonner l\'inscription',
            text: 'Êtes-vous sûr de vouloir marquer cette inscription comme abandonnée ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, abandonner',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/inscriptions/' + id + '/abandonner',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Abandonné!', 'L\'inscription a été marquée comme abandonnée', 'warning');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endpush