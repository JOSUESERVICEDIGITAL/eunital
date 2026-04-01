@extends('back.formation.layouts.app')

@section('title', 'Devoirs')
@section('page_title', 'Gestion des devoirs')
@section('page_subtitle', 'Liste et suivi des devoirs, exercices et évaluations')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-tasks mr-2"></i>
            Tous les devoirs
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.devoirs.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouveau devoir
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
                        <th>Titre</th>
                        <th>Cours</th>
                        <th>Type</th>
                        <th>Date limite</th>
                        <th>Soumissions</th>
                        <th>Note moyenne</th>
                        <th>Statut</th>
                        <th style="width: 120px">Actions</th>
                    </thead>
                <tbody>
                    @forelse($devoirs as $devoir)
                    <tr>
                        <td>{{ $devoir->id }}</td>
                        <td>
                            <strong>{{ $devoir->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($devoir->description, 50) }}</small>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.cours.show', $devoir->cour) }}" class="text-info">
                                {{ $devoir->cour->titre }}
                            </a>
                        </td>
                        <td>
                            @include('back.formation.partials.status-badge', ['status' => $devoir->type])
                        </td>
                        <td>
                            @if($devoir->date_limite)
                                {{ \Carbon\Carbon::parse($devoir->date_limite)->format('d/m/Y H:i') }}
                                @if($devoir->est_expire)
                                    <br>
                                    <span class="badge badge-danger">Expiré</span>
                                @endif
                            @else
                                <span class="text-muted">Aucune</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $devoir->soumissions_count }}</span>
                            @if($devoir->nb_soumissions_non_corrigees > 0)
                                <br>
                                <span class="badge badge-warning">{{ $devoir->nb_soumissions_non_corrigees }} à corriger</span>
                            @endif
                        </td>
                        <td>
                            @if($devoir->moyenne > 0)
                                <span class="badge badge-{{ $devoir->moyenne >= ($devoir->note_maximale * 0.6) ? 'success' : 'warning' }}">
                                    {{ round($devoir->moyenne, 1) }}/{{ $devoir->note_maximale }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($devoir->is_published)
                                <span class="badge badge-success">Publié</span>
                            @else
                                <span class="badge badge-secondary">Brouillon</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.devoirs.show', $devoir) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('back.formation.devoirs.edit', $devoir) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if(!$devoir->is_published)
                                    <button type="button" class="btn btn-sm btn-success" onclick="publierDevoir({{ $devoir->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                @endif
                                <form action="{{ route('back.formation.devoirs.destroy', $devoir) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <i class="fas fa-tasks fa-3x text-muted mb-3 d-block"></i>
                            Aucun devoir trouvé
                            <br>
                            <a href="{{ route('back.formation.devoirs.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Créer le premier devoir
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
                Affichage de {{ $devoirs->firstItem() ?? 0 }} à {{ $devoirs->lastItem() ?? 0 }} sur {{ $devoirs->total() }} devoirs
            </div>
            @include('back.formation.partials.pagination', ['items' => $devoirs])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.devoirs.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les devoirs</h5>
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
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="">Tous les types</option>
                            <option value="exercice" {{ request('type') == 'exercice' ? 'selected' : '' }}>Exercice</option>
                            <option value="quiz" {{ request('type') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                            <option value="projet" {{ request('type') == 'projet' ? 'selected' : '' }}>Projet</option>
                            <option value="examen" {{ request('type') == 'examen' ? 'selected' : '' }}>Examen</option>
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
                    <a href="{{ route('back.formation.devoirs.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function publierDevoir(id) {
        Swal.fire({
            title: 'Publier le devoir',
            text: 'Les étudiants pourront voir et soumettre ce devoir une fois publié.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, publier',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/devoirs/' + id + '/publier',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Publié!', 'Le devoir a été publié', 'success');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endpush