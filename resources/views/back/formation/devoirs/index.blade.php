@extends('back.formation.layouts.app')

@section('title', 'Devoirs')
@section('page_title', 'Gestion des devoirs')
@section('page_subtitle', 'Liste, suivi, publication et correction des devoirs, quiz, projets et examens')

@section('formation-content')
<div class="row mb-3">
    <div class="col-md-3 col-6">
        <div class="small-box bg-primary shadow-sm">
            <div class="inner">
                <h3>{{ $devoirs->total() ?? 0 }}</h3>
                <p>Total devoirs</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>{{ collect($devoirs->items())->where('is_published', true)->count() }}</h3>
                <p>Publiés</p>
            </div>
            <div class="icon">
                <i class="fas fa-eye"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3>{{ collect($devoirs->items())->sum('nb_soumissions_non_corrigees') }}</h3>
                <p>À corriger</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-double"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-danger shadow-sm">
            <div class="inner">
                <h3>{{ collect($devoirs->items())->filter(fn($d) => $d->est_expire ?? false)->count() }}</h3>
                <p>Expirés</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="card-title mb-1">
                <i class="fas fa-tasks mr-2 text-primary"></i>
                Tous les devoirs
            </h3>
            <small class="text-muted">Centralisez les évaluations et accédez rapidement aux cours, salles et soumissions.</small>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-light btn-sm border" data-toggle="modal" data-target="#filterModal">
                <i class="fas fa-filter mr-1"></i> Filtrer
            </button>

            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#quickActionsModal">
                <i class="fas fa-bolt mr-1"></i> Actions rapides
            </button>

            <a href="{{ route('back.formation.devoirs.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus mr-1"></i> Nouveau devoir
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 60px">#</th>
                        <th>Devoir</th>
                        <th>Cours</th>
                        <th>Type</th>
                        <th>Échéance</th>
                        <th>Soumissions</th>
                        <th>Moyenne</th>
                        <th>Statut</th>
                        <th style="width: 140px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($devoirs as $devoir)
                        <tr>
                            <td class="font-weight-bold text-muted">#{{ $devoir->id }}</td>

                            <td>
                                <div class="font-weight-bold text-dark">{{ $devoir->titre }}</div>
                                <div class="small text-muted">{{ Str::limit(strip_tags($devoir->description), 70) }}</div>

                                <div class="mt-2 d-flex flex-wrap gap-1">
                                    @if($devoir->date_limite && ($devoir->est_expire ?? false))
                                        <span class="badge badge-danger">Expiré</span>
                                    @elseif($devoir->date_limite)
                                        <span class="badge badge-info">En cours</span>
                                    @else
                                        <span class="badge badge-secondary">Sans limite</span>
                                    @endif

                                    @if(($devoir->nb_soumissions_non_corrigees ?? 0) > 0)
                                        <span class="badge badge-warning">{{ $devoir->nb_soumissions_non_corrigees }} à corriger</span>
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div>
                                    <a href="{{ route('back.formation.cours.show', $devoir->cour) }}" class="font-weight-bold text-info">
                                        {{ $devoir->cour->titre ?? 'N/A' }}
                                    </a>
                                </div>

                                <div class="small text-muted mt-1 d-flex flex-wrap gap-2">
                                    <a href="{{ route('back.formation.acces-salles.index') }}?cour_id={{ $devoir->cour->id ?? '' }}" class="text-secondary">
                                        <i class="fas fa-door-open mr-1"></i>Salle
                                    </a>

                                    <a href="{{ route('back.formation.presences.index') }}?cour_id={{ $devoir->cour->id ?? '' }}" class="text-secondary">
                                        <i class="fas fa-user-check mr-1"></i>Présences
                                    </a>
                                </div>
                            </td>

                            <td>
                                @include('back.formation.partials.status-badge', ['status' => $devoir->type])
                            </td>

                            <td>
                                @if($devoir->date_limite)
                                    <div>{{ \Carbon\Carbon::parse($devoir->date_limite)->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($devoir->date_limite)->format('H:i') }}</small>
                                @else
                                    <span class="text-muted">Aucune</span>
                                @endif
                            </td>

                            <td>
                                <span class="badge badge-info px-2 py-1">{{ $devoir->soumissions_count ?? 0 }}</span>

                                @if(($devoir->nb_soumissions_non_corrigees ?? 0) > 0)
                                    <div class="mt-1">
                                        <a href="{{ route('back.formation.soumissions.a-corriger') }}?devoir={{ $devoir->id }}"
                                           class="small text-warning font-weight-bold">
                                            Corriger maintenant
                                        </a>
                                    </div>
                                @endif
                            </td>

                            <td>
                                @if(($devoir->moyenne ?? 0) > 0)
                                    @php
                                        $moyenneOk = $devoir->moyenne >= (($devoir->note_maximale ?? 20) * 0.6);
                                    @endphp
                                    <span class="badge badge-{{ $moyenneOk ? 'success' : 'warning' }}">
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
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle border" type="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                                        <a class="dropdown-item" href="{{ route('back.formation.devoirs.show', $devoir) }}">
                                            <i class="fas fa-eye text-info mr-2"></i> Voir
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.devoirs.edit', $devoir) }}">
                                            <i class="fas fa-edit text-warning mr-2"></i> Modifier
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.cours.show', $devoir->cour) }}">
                                            <i class="fas fa-book text-primary mr-2"></i> Ouvrir le cours
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.soumissions.index') }}?devoir={{ $devoir->id }}">
                                            <i class="fas fa-inbox text-secondary mr-2"></i> Voir les soumissions
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.acces-salles.index') }}?cour_id={{ $devoir->cour->id ?? '' }}">
                                            <i class="fas fa-door-open text-dark mr-2"></i> Accès salle liée
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.presences.index') }}?cour_id={{ $devoir->cour->id ?? '' }}">
                                            <i class="fas fa-calendar-check text-success mr-2"></i> Présences du cours
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        @if(!$devoir->is_published)
                                            <button type="button" class="dropdown-item text-success" onclick="publierDevoir({{ $devoir->id }})">
                                                <i class="fas fa-upload mr-2"></i> Publier
                                            </button>
                                        @else
                                            <button type="button" class="dropdown-item text-secondary" onclick="depublierDevoir({{ $devoir->id }})">
                                                <i class="fas fa-eye-slash mr-2"></i> Dépublier
                                            </button>
                                        @endif

                                        <button type="button" class="dropdown-item text-primary" data-toggle="modal" data-target="#duplicateModal{{ $devoir->id }}">
                                            <i class="fas fa-copy mr-2"></i> Dupliquer
                                        </button>

                                        <div class="dropdown-divider"></div>

                                        <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target="#deleteModal{{ $devoir->id }}">
                                            <i class="fas fa-trash mr-2"></i> Supprimer
                                        </button>
                                    </div>
                                </div>

                                {{-- Modal suppression --}}
                                <div class="modal fade" id="deleteModal{{ $devoir->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i> Supprimer le devoir
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer <strong>{{ $devoir->titre }}</strong> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                                                <form action="{{ route('back.formation.devoirs.destroy', $devoir) }}" method="POST">
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

                                {{-- Modal duplication --}}
                                <div class="modal fade" id="duplicateModal{{ $devoir->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <form action="{{ route('back.formation.devoirs.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-copy mr-2"></i> Dupliquer le devoir
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nouveau titre</label>
                                                        <input type="text" name="titre" class="form-control" value="{{ $devoir->titre }} (copie)" required>
                                                    </div>

                                                    <input type="hidden" name="description" value="{{ $devoir->description }}">
                                                    <input type="hidden" name="cour_id" value="{{ $devoir->cour_id }}">
                                                    <input type="hidden" name="type" value="{{ $devoir->type }}">
                                                    <input type="hidden" name="date_limite" value="{{ $devoir->date_limite }}">
                                                    <input type="hidden" name="note_maximale" value="{{ $devoir->note_maximale }}">
                                                    <input type="hidden" name="is_published" value="0">

                                                    <div class="alert alert-light border mb-0">
                                                        La copie sera créée comme <strong>brouillon</strong>.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-copy mr-1"></i> Créer la copie
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-tasks fa-3x text-muted mb-3 d-block"></i>
                                <div class="font-weight-bold">Aucun devoir trouvé</div>
                                <div class="text-muted mb-3">Commencez par créer un devoir, quiz, projet ou examen.</div>
                                <a href="{{ route('back.formation.devoirs.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus mr-1"></i> Créer le premier devoir
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
            Affichage de {{ $devoirs->firstItem() ?? 0 }} à {{ $devoirs->lastItem() ?? 0 }} sur {{ $devoirs->total() }} devoirs
        </div>
        @include('back.formation.partials.pagination', ['items' => $devoirs])
    </div>
</div>

{{-- Modal filtres --}}
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form method="GET" action="{{ route('back.formation.devoirs.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-filter mr-2"></i> Filtrer les devoirs
                    </h5>
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
                            <option value="expire" {{ request('statut') == 'expire' ? 'selected' : '' }}>Expiré</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('back.formation.devoirs.index') }}" class="btn btn-light">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check mr-1"></i> Appliquer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal actions rapides --}}
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
                <a href="{{ route('back.formation.devoirs.create') }}" class="btn btn-primary m-1">
                    <i class="fas fa-plus mr-1"></i> Nouveau devoir
                </a>

                <a href="{{ route('back.formation.soumissions.a-corriger') }}" class="btn btn-warning m-1">
                    <i class="fas fa-check-double mr-1"></i> À corriger
                </a>

                <a href="{{ route('back.formation.acces-salles.index') }}" class="btn btn-dark m-1">
                    <i class="fas fa-door-open mr-1"></i> Accès salles
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

    function publierDevoir(id) {
        Swal.fire({
            title: 'Publier le devoir ?',
            text: 'Les étudiants pourront le consulter et le soumettre.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, publier',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#28a745'
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
                        Swal.fire('Publié', 'Le devoir a été publié avec succès.', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Erreur', 'La publication a échoué.', 'error');
                    }
                });
            }
        });
    }

    function depublierDevoir(id) {
        Swal.fire({
            title: 'Dépublier ce devoir ?',
            text: 'Les étudiants ne pourront plus le voir.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, dépublier',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/devoirs/' + id + '/depublier',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        Swal.fire('Dépublié', 'Le devoir a été retiré de la publication.', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Erreur', 'La dépublication a échoué.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
