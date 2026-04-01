@extends('back.formation.layouts.app')

@section('title', 'Progressions')
@section('page_title', 'Suivi des progressions')
@section('page_subtitle', 'Suivi de l\'avancement des apprenants dans les cours')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chart-line mr-2"></i>
            Toutes les progressions
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.progressions.barres') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-chart-simple"></i> Barres de progression
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    肇
                        <th style="width: 50px">#</th>
                        <th>Étudiant</th>
                        <th>Cours</th>
                        <th>Module</th>
                        <th>Progression</th>
                        <th>Dernier accès</th>
                        <th>Statut</th>
                        <th style="width: 100px">Actions</th>
                    </thead>
                <tbody>
                    @forelse($progressions as $progression)
                     <tr>
                         <td>{{ $progression->id }}</td>
                         <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ substr($progression->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $progression->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $progression->user->email }}</small>
                                </div>
                            </div>
                         </td>
                         <td>
                            <a href="{{ route('back.formation.cours.show', $progression->cour) }}" class="text-info">
                                {{ $progression->cour->titre }}
                            </a>
                         </td>
                         <td>
                            <span class="badge badge-secondary">{{ $progression->cour->module->titre ?? 'N/A' }}</span>
                         </td>
                         <td style="width: 150px">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-{{ $progression->progression >= 100 ? 'success' : 'primary' }}" 
                                     style="width: {{ $progression->progression }}%">
                                </div>
                            </div>
                            <small class="text-muted">{{ $progression->progression }}%</small>
                         </td>
                         <td>
                            {{ $progression->dernier_acces ? \Carbon\Carbon::parse($progression->dernier_acces)->format('d/m/Y H:i') : '-' }}
                            <br>
                            <small class="text-muted">il y a {{ \Carbon\Carbon::parse($progression->dernier_acces)->diffForHumans() }}</small>
                         </td>
                         <td>
                            @if($progression->termine)
                                <span class="badge badge-success">Terminé</span>
                            @elseif($progression->progression > 0)
                                <span class="badge badge-primary">En cours</span>
                            @else
                                <span class="badge badge-secondary">Non commencé</span>
                            @endif
                         </td>
                         <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.progressions.show', $progression) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('back.formation.progressions.edit', $progression) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="resetProgression({{ $progression->id }})">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </div>
                         </td>
                     </tr>
                    @empty
                     <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-chart-line fa-3x text-muted mb-3 d-block"></i>
                            Aucune progression trouvée
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
                Affichage de {{ $progressions->firstItem() ?? 0 }} à {{ $progressions->lastItem() ?? 0 }} sur {{ $progressions->total() }} progressions
            </div>
            @include('back.formation.partials.pagination', ['items' => $progressions])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.progressions.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les progressions</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cours</label>
                        <select name="cour_id" class="form-control">
                            <option value="">Tous les cours</option>
                            @foreach($cours ?? [] as $cour)
                            <option value="{{ $cour->id }}" {{ request('cour_id') == $cour->id ? 'selected' : '' }}>
                                {{ $cour->titre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Étudiant</label>
                        <select name="user_id" class="form-control">
                            <option value="">Tous les étudiants</option>
                            @foreach($utilisateurs ?? [] as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="statut" class="form-control">
                            <option value="">Tous</option>
                            <option value="termine" {{ request('statut') == 'termine' ? 'selected' : '' }}>Terminé</option>
                            <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="non_commence" {{ request('statut') == 'non_commence' ? 'selected' : '' }}>Non commencé</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.progressions.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function resetProgression(id) {
        Swal.fire({
            title: 'Réinitialiser la progression',
            text: 'Cette action remettra la progression à 0. L\'étudiant devra recommencer le cours.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/progressions/' + id + '/reset',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Réinitialisé!', 'La progression a été réinitialisée', 'success');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endpush