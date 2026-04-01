@extends('back.formation.layouts.app')

@section('title', 'Soumissions')
@section('page_title', 'Gestion des soumissions')
@section('page_subtitle', 'Liste de toutes les soumissions de devoirs')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-inbox mr-2"></i>
            Toutes les soumissions
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.soumissions.a-corriger') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-check-double"></i> À corriger
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
                        <th>Devoir</th>
                        <th>Cours</th>
                        <th>Soumis le</th>
                        <th>Note</th>
                        <th>Statut</th>
                        <th style="width: 120px">Actions</th>
                    </thead>
                <tbody>
                    @forelse($soumissions as $soumission)
                    <tr>
                        <td>{{ $soumission->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ substr($soumission->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $soumission->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $soumission->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $soumission->devoir->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ $soumission->devoir->type }}</small>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.cours.show', $soumission->devoir->cour) }}" class="text-info">
                                {{ $soumission->devoir->cour->titre }}
                            </a>
                        </td>
                        <td>
                            {{ $soumission->soumis_le->format('d/m/Y H:i') }}
                            @if($soumission->est_en_retard)
                                <br>
                                <span class="badge badge-danger">En retard</span>
                            @endif
                        </td>
                        <td>
                            @if($soumission->note)
                                <span class="badge badge-{{ $soumission->note >= ($soumission->devoir->note_maximale * 0.6) ? 'success' : 'warning' }}">
                                    {{ $soumission->note }}/{{ $soumission->devoir->note_maximale }}
                                </span>
                            @else
                                <span class="badge badge-secondary">En attente</span>
                            @endif
                        </td>
                        <td>
                            @if($soumission->est_corrige)
                                <span class="badge badge-success">Corrigé</span>
                            @else
                                <span class="badge badge-warning">À corriger</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.soumissions.show', $soumission) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$soumission->est_corrige)
                                    <a href="{{ route('back.formation.soumissions.show', $soumission) }}#correction" class="btn btn-sm btn-warning">
                                        <i class="fas fa-check-double"></i>
                                    </a>
                                @endif
                                <form action="{{ route('back.formation.soumissions.destroy', $soumission) }}" method="POST" class="d-inline">
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
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                            Aucune soumission trouvée
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
                Affichage de {{ $soumissions->firstItem() ?? 0 }} à {{ $soumissions->lastItem() ?? 0 }} sur {{ $soumissions->total() }} soumissions
            </div>
            @include('back.formation.partials.pagination', ['items' => $soumissions])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.soumissions.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les soumissions</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Devoir</label>
                        <select name="devoir_id" class="form-control">
                            <option value="">Tous les devoirs</option>
                            @foreach($devoirs ?? [] as $devoir)
                            <option value="{{ $devoir->id }}" {{ request('devoir_id') == $devoir->id ? 'selected' : '' }}>
                                {{ $devoir->titre }}
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
                            <option value="corrige" {{ request('statut') == 'corrige' ? 'selected' : '' }}>Corrigé</option>
                            <option value="non_corrige" {{ request('statut') == 'non_corrige' ? 'selected' : '' }}>À corriger</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.soumissions.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection