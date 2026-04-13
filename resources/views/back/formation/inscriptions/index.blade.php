@extends('back.formation.layouts.app')

@section('title', 'Inscriptions')
@section('page_title', 'Gestion des inscriptions')
@section('page_subtitle', 'Liste, validation, suivi et navigation rapide des inscriptions')

@section('formation-content')
<div class="row mb-3">
    <div class="col-md-3 col-6">
        <div class="small-box bg-primary shadow-sm">
            <div class="inner">
                <h3>{{ $inscriptions->total() ?? 0 }}</h3>
                <p>Total inscriptions</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3>{{ collect($inscriptions->items())->where('statut', 'en_attente')->count() }}</h3>
                <p>En attente</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>{{ collect($inscriptions->items())->where('statut', 'valide')->count() }}</h3>
                <p>Validées</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-info shadow-sm">
            <div class="inner">
                <h3>{{ round(collect($inscriptions->items())->avg('progression') ?? 0, 1) }}%</h3>
                <p>Progression moyenne</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="card-title mb-1">
                <i class="fas fa-users mr-2 text-primary"></i>
                Toutes les inscriptions
            </h3>
            <small class="text-muted">Valide, édite, suis et navigue rapidement vers les modules, cours et activités.</small>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-light btn-sm border" data-toggle="modal" data-target="#filterModal">
                <i class="fas fa-filter mr-1"></i> Filtrer
            </button>

            <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#quickActionsModal">
                <i class="fas fa-bolt mr-1"></i> Actions rapides
            </button>

            <a href="{{ route('back.formation.inscriptions.en-attente') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-clock mr-1"></i> En attente
            </a>

            <a href="{{ route('back.formation.inscriptions.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus mr-1"></i> Nouvelle inscription
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 60px">#</th>
                        <th>Étudiant</th>
                        <th>Module</th>
                        <th>Inscription</th>
                        <th>Progression</th>
                        <th>Statut</th>
                        <th style="width: 130px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscriptions as $inscription)
                        <tr>
                            <td class="text-muted font-weight-bold">#{{ $inscription->id }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle mr-2" style="width: 38px; height: 38px; font-size: 15px;">
                                        {{ strtoupper(substr($inscription->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-weight-bold">{{ $inscription->user->name }}</div>
                                        <small class="text-muted">{{ $inscription->user->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('back.formation.modules.show', $inscription->module) }}" class="font-weight-bold text-info">
                                    {{ $inscription->module->titre }}
                                </a>
                                <br>
                                <small class="text-muted">{{ $inscription->module->categorie->nom ?? 'N/A' }}</small>

                                <div class="mt-1 small">
                                    <a href="{{ route('back.formation.cours.index') }}?module_id={{ $inscription->module->id }}" class="text-secondary">
                                        <i class="fas fa-book mr-1"></i>Voir les cours
                                    </a>
                                </div>
                            </td>

                            <td>
                                <div>{{ $inscription->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $inscription->created_at->format('H:i') }}</small>
                            </td>

                            <td>
                                <div class="progress" style="height: 8px; width: 110px;">
                                    <div class="progress-bar bg-primary" style="width: {{ $inscription->progression }}%"></div>
                                </div>
                                <small class="font-weight-bold">{{ $inscription->progression }}%</small>
                            </td>

                            <td>
                                @include('back.formation.partials.status-badge', ['status' => $inscription->statut])
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle border" type="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                                        <a class="dropdown-item" href="{{ route('back.formation.inscriptions.show', $inscription) }}">
                                            <i class="fas fa-eye text-info mr-2"></i> Voir
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.inscriptions.edit', $inscription) }}">
                                            <i class="fas fa-edit text-warning mr-2"></i> Modifier
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.modules.show', $inscription->module) }}">
                                            <i class="fas fa-layer-group text-primary mr-2"></i> Voir le module
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.presences.index') }}?inscription_id={{ $inscription->id }}">
                                            <i class="fas fa-user-check text-success mr-2"></i> Présences
                                        </a>

                                        @if($inscription->statut === 'en_attente')
                                            <button type="button" class="dropdown-item text-success" onclick="validerInscription({{ $inscription->id }})">
                                                <i class="fas fa-check-circle mr-2"></i> Valider
                                            </button>
                                        @endif

                                        @if(in_array($inscription->statut, ['en_attente', 'valide']))
                                            <button type="button" class="dropdown-item text-danger" onclick="abandonnerInscription({{ $inscription->id }})">
                                                <i class="fas fa-times-circle mr-2"></i> Abandonner
                                            </button>
                                        @endif

                                        <div class="dropdown-divider"></div>

                                        <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target="#deleteModal{{ $inscription->id }}">
                                            <i class="fas fa-trash mr-2"></i> Supprimer
                                        </button>
                                    </div>
                                </div>

                                <div class="modal fade" id="deleteModal{{ $inscription->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i> Supprimer l'inscription
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer l'inscription de
                                                <strong>{{ $inscription->user->name }}</strong> au module
                                                <strong>{{ $inscription->module->titre }}</strong> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                                                <form action="{{ route('back.formation.inscriptions.destroy', $inscription) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash mr-1"></i> Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                                <div class="font-weight-bold">Aucune inscription trouvée</div>
                                <div class="text-muted mb-3">Commence par créer une première inscription.</div>
                                <a href="{{ route('back.formation.inscriptions.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus mr-1"></i> Créer la première inscription
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-white d-flex flex-wrap justify-content-between align-items-center">
        <div class="text-muted small">
            Affichage de {{ $inscriptions->firstItem() ?? 0 }} à {{ $inscriptions->lastItem() ?? 0 }} sur {{ $inscriptions->total() }} inscriptions
        </div>
        @include('back.formation.partials.pagination', ['items' => $inscriptions])
    </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form method="GET" action="{{ route('back.formation.inscriptions.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-filter mr-2"></i> Filtrer les inscriptions
                    </h5>
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

                    <div class="form-group mb-0">
                        <label>Date fin</label>
                        <input type="date" name="date_fin" class="form-control" value="{{ request('date_fin') }}">
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-light">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check mr-1"></i> Appliquer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="quickActionsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fas fa-bolt mr-2"></i> Actions rapides
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <a href="{{ route('back.formation.inscriptions.create') }}" class="btn btn-primary m-1">
                    <i class="fas fa-plus mr-1"></i> Nouvelle inscription
                </a>
                <a href="{{ route('back.formation.inscriptions.en-attente') }}" class="btn btn-warning m-1">
                    <i class="fas fa-clock mr-1"></i> En attente
                </a>
                <a href="{{ route('back.formation.modules.index') }}" class="btn btn-info m-1">
                    <i class="fas fa-layer-group mr-1"></i> Modules
                </a>
                <a href="{{ route('back.formation.presences.index') }}" class="btn btn-success m-1">
                    <i class="fas fa-user-check mr-1"></i> Présences
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function validerInscription(id) {
        Swal.fire({
            title: 'Valider l’inscription ?',
            text: 'L’étudiant pourra accéder au module.',
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
                    success: function() {
                        Swal.fire('Validé', 'L’inscription a été validée.', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Erreur', 'Impossible de valider.', 'error');
                    }
                });
            }
        });
    }

    function abandonnerInscription(id) {
        Swal.fire({
            title: 'Abandonner cette inscription ?',
            text: 'Elle sera marquée comme abandonnée.',
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
                    success: function() {
                        Swal.fire('Abandonné', 'L’inscription a été mise à jour.', 'warning')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Erreur', 'Impossible de modifier le statut.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
