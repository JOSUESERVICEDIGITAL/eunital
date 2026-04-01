@extends('back.formation.layouts.app')

@section('title', 'Progression par étudiant')
@section('page_title', 'Progression par étudiant')
@section('page_subtitle', 'Analyse de l\'avancement individuel')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-graduate mr-2"></i>
            Progression par étudiant
        </h3>
        <div class="card-tools">
            <form method="GET" action="{{ route('back.formation.progressions.par-eleve') }}" class="form-inline">
                <div class="form-group mr-2">
                    <label class="mr-2">Étudiant :</label>
                    <select name="user_id" class="form-control form-control-sm">
                        <option value="">Tous les étudiants</option>
                        @foreach($utilisateurs as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-search"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.progressions.par-eleve') }}" class="btn btn-secondary btn-sm ml-2">
                    <i class="fas fa-undo"></i> Réinitialiser
                </a>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    肇
                        <th>Cours</th>
                        <th>Module</th>
                        <th>Progression</th>
                        <th>Statut</th>
                        <th>Dernier accès</th>
                        <th>Actions</th>
                    </thead>
                <tbody>
                    @forelse($progressions as $progression)
                    <tr>
                        <td>
                            <a href="{{ route('back.formation.cours.show', $progression->cour) }}" class="text-info">
                                {{ $progression->cour->titre }}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-secondary">{{ $progression->cour->module->titre ?? 'N/A' }}</span>
                        </td>
                        <td style="width: 200px">
                            <div class="d-flex align-items-center">
                                <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                    <div class="progress-bar bg-{{ $progression->progression >= 100 ? 'success' : 'primary' }}" 
                                         style="width: {{ $progression->progression }}%">
                                    </div>
                                </div>
                                <span class="small">{{ $progression->progression }}%</span>
                            </div>
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
                            {{ $progression->dernier_acces ? \Carbon\Carbon::parse($progression->dernier_acces)->format('d/m/Y H:i') : '-' }}
                            <br>
                            <small class="text-muted">il y a {{ \Carbon\Carbon::parse($progression->dernier_acces)->diffForHumans() }}</small>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.progressions.show', $progression) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-user-graduate fa-3x text-muted mb-3 d-block"></i>
                            Aucune progression trouvée pour cet étudiant
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $progressions])
    </div>
</div>

@if(request('user_id'))
@php
    $user = $utilisateurs->find(request('user_id'));
    $stats = [
        'total_cours' => $progressions->count(),
        'termines' => $progressions->where('termine', true)->count(),
        'en_cours' => $progressions->where('progression', '>', 0)->where('termine', false)->count(),
        'non_commences' => $progressions->where('progression', 0)->count(),
        'progression_moyenne' => $progressions->avg('progression') ?? 0
    ];
@endphp
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple mr-2"></i>
                    Statistiques de l'étudiant : {{ $user->name }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Total cours</span>
                                <span class="info-box-number">{{ $stats['total_cours'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Terminés</span>
                                <span class="info-box-number">{{ $stats['termines'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">En cours</span>
                                <span class="info-box-number">{{ $stats['en_cours'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Progression moyenne</span>
                                <span class="info-box-number">{{ round($stats['progression_moyenne'], 1) }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection