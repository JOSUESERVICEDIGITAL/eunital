@extends('back.formation.layouts.app')

@section('title', 'Rapport présences')
@section('page_title', 'Rapport des présences')
@section('page_subtitle', 'Statistiques et analyse des présences')

@section('formation-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Filtres
                </h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('back.formation.presences.rapport') }}" class="form-inline">
                    <div class="form-group mr-2 mb-2">
                        <label class="mr-2">Module :</label>
                        <select name="module_id" class="form-control">
                            <option value="">Tous les modules</option>
                            @foreach($modules as $module)
                            <option value="{{ $module->id }}" {{ request('module_id') == $module->id ? 'selected' : '' }}>
                                {{ $module->titre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-2 mb-2">
                        <label class="mr-2">Date début :</label>
                        <input type="date" name="date_debut" class="form-control" value="{{ request('date_debut') }}">
                    </div>
                    <div class="form-group mr-2 mb-2">
                        <label class="mr-2">Date fin :</label>
                        <input type="date" name="date_fin" class="form-control" value="{{ request('date_fin') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="fas fa-search"></i> Générer
                    </button>
                    <a href="{{ route('back.formation.presences.rapport') }}" class="btn btn-secondary mb-2 ml-2">
                        <i class="fas fa-undo"></i> Réinitialiser
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total'] }}</h3>
                <p>Total présences</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['present'] }}</h3>
                <p>Présents</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['absent'] }}</h3>
                <p>Absents</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-times"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['taux_presence'] }}%</h3>
                <p>Taux de présence</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-2"></i>
                    Répartition des présences
                </h3>
            </div>
            <div class="card-body">
                <canvas id="presenceChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Évolution des présences
                </h3>
            </div>
            <div class="card-body">
                <canvas id="evolutionChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-table mr-2"></i>
                    Détail des présences
                </h3>
                <div class="card-tools">
                    <button class="btn btn-success btn-sm" onclick="exportToExcel()">
                        <i class="fas fa-file-excel"></i> Exporter Excel
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="presencesTable">
                        <thead>
                             <tr>
                                <th>Étudiant</th>
                                <th>Cours</th>
                                <th>Date</th>
                                <th>Heure début</th>
                                <th>Durée</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($presences as $presence)
                            <tr>
                                <td>{{ $presence->inscription->user->name }}</td>
                                <td>{{ $presence->cour->titre }}</td>
                                <td>{{ \Carbon\Carbon::parse($presence->date_debut)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($presence->date_debut)->format('H:i') }}</td>
                                <td>{{ floor($presence->duree_connexion / 60) }} min {{ $presence->duree_connexion % 60 }} sec</td>
                                <td>
                                    @if($presence->present)
                                        <span class="badge badge-success">Présent</span>
                                    @else
                                        <span class="badge badge-danger">Absent</span>
                                    @endif
                                    @if($presence->statut != 'present' && $presence->statut != 'absent')
                                        <br><small>{{ $presence->statut }}</small>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune présence trouvée</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // Graphique des présences
        var ctx1 = document.getElementById('presenceChart').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Présents ({{ $stats["present"] }})', 'Absents ({{ $stats["absent"] }})'],
                datasets: [{
                    data: [{{ $stats["present"] }}, {{ $stats["absent"] }}],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        
        // Graphique d'évolution
        @php
            $evolution = $presences->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->date_debut)->format('Y-m-d');
            })->map(function($group) {
                return [
                    'total' => $group->count(),
                    'present' => $group->where('present', true)->count()
                ];
            });
        @endphp
        
        var ctx2 = document.getElementById('evolutionChart').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: {!! json_encode($evolution->keys()) !!},
                datasets: [
                    {
                        label: 'Total présences',
                        data: {!! json_encode($evolution->pluck('total')) !!},
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        fill: true
                    },
                    {
                        label: 'Présents',
                        data: {!! json_encode($evolution->pluck('present')) !!},
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
    
    function exportToExcel() {
        var table = document.getElementById('presencesTable');
        var html = table.outerHTML;
        var url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
        var link = document.createElement('a');
        link.href = url;
        link.download = 'rapport_presences_' + new Date().toISOString().slice(0,19) + '.xls';
        link.click();
    }
</script>
@endpush