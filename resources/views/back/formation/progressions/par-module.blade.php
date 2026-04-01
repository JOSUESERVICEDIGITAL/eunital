@extends('back.formation.layouts.app')

@section('title', 'Progression par module')
@section('page_title', 'Progression par module')
@section('page_subtitle', 'Analyse de l\'avancement par module de formation')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-folder-open mr-2"></i>
            Progression par module
        </h3>
        <div class="card-tools">
            <form method="GET" action="{{ route('back.formation.progressions.par-module') }}" class="form-inline">
                <div class="form-group mr-2">
                    <label class="mr-2">Module :</label>
                    <select name="module_id" class="form-control form-control-sm">
                        <option value="">Tous les modules</option>
                        @foreach($modules as $module)
                        <option value="{{ $module->id }}" {{ request('module_id') == $module->id ? 'selected' : '' }}>
                            {{ $module->titre }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-search"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.progressions.par-module') }}" class="btn btn-secondary btn-sm ml-2">
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
                        <th>Étudiant</th>
                        <th>Cours</th>
                        <th>Progression</th>
                        <th>Statut</th>
                        <th>Dernier accès</th>
                        <th>Actions</th>
                    </thead>
                <tbody>
                    @forelse($progressions as $progression)
                    <tr>
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
                            <i class="fas fa-chart-line fa-3x text-muted mb-3 d-block"></i>
                            Aucune progression trouvée pour ce module
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

@if(request('module_id'))
@php
    $module = $modules->find(request('module_id'));
    $stats = [
        'total_etudiants' => $progressions->total(),
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
                    Statistiques du module : {{ $module->titre }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Total étudiants</span>
                                <span class="info-box-number">{{ $stats['total_etudiants'] }}</span>
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