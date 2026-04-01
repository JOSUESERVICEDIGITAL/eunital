@extends('back.formation.layouts.app')

@section('title', 'Présences')
@section('page_title', 'Gestion des présences')
@section('page_subtitle', 'Suivi des présences aux cours')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-calendar-check mr-2"></i>
            Liste des présences
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.presences.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouvelle présence
                </a>
                <a href="{{ route('back.formation.presences.rapport') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-chart-bar"></i> Rapport
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
                        <th>Cours</th>
                        <th>Date</th>
                        <th>Heure début</th>
                        <th>Durée</th>
                        <th>Statut</th>
                        <th>Code accès</th>
                        <th style="width: 100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presences as $presence)
                    <tr>
                        <td>{{ $presence->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ substr($presence->inscription->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $presence->inscription->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $presence->inscription->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.cours.show', $presence->cour) }}" class="text-info">
                                {{ $presence->cour->titre }}
                            </a>
                        </td>
                        <td>
                            @if($presence->date_debut)
                                {{ \Carbon\Carbon::parse($presence->date_debut)->format('d/m/Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($presence->date_debut)
                                {{ \Carbon\Carbon::parse($presence->date_debut)->format('H:i') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($presence->duree_connexion)
                                {{ floor($presence->duree_connexion / 60) }} min
                                {{ $presence->duree_connexion % 60 }} sec
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($presence->present)
                                <span class="badge badge-success">Présent</span>
                            @else
                                <span class="badge badge-danger">Absent</span>
                            @endif
                            @if($presence->statut != 'present' && $presence->statut != 'absent')
                                <br>
                                <small class="text-muted">{{ $presence->statut }}</small>
                            @endif
                        </td>
                        <td>
                            @if($presence->code_acces)
                                <code class="small">{{ $presence->code_acces }}</code>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @include('back.formation.partials.table-actions', [
                                'showRoute' => route('back.formation.presences.show', $presence),
                                'editRoute' => route('back.formation.presences.edit', $presence),
                                'deleteRoute' => route('back.formation.presences.destroy', $presence)
                            ])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <i class="fas fa-calendar-check fa-3x text-muted mb-3 d-block"></i>
                            Aucune présence enregistrée
                            <br>
                            <a href="{{ route('back.formation.presences.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Enregistrer une présence
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
                Affichage de {{ $presences->firstItem() ?? 0 }} à {{ $presences->lastItem() ?? 0 }} sur {{ $presences->total() }} présences
            </div>
            @include('back.formation.partials.pagination', ['items' => $presences])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.presences.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les présences</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                        <label>Statut</label>
                        <select name="statut" class="form-control">
                            <option value="">Tous</option>
                            <option value="present" {{ request('statut') == 'present' ? 'selected' : '' }}>Présent</option>
                            <option value="absent" {{ request('statut') == 'absent' ? 'selected' : '' }}>Absent</option>
                            <option value="retard" {{ request('statut') == 'retard' ? 'selected' : '' }}>Retard</option>
                            <option value="excusé" {{ request('statut') == 'excusé' ? 'selected' : '' }}>Excusé</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date début</label>
                                <input type="date" name="date_debut" class="form-control" value="{{ request('date_debut') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date fin</label>
                                <input type="date" name="date_fin" class="form-control" value="{{ request('date_fin') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.presences.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection