@extends('back.formation.layouts.app')

@section('title', 'Dashboard Formation')
@section('page_title', 'Tableau de bord')
@section('page_subtitle', 'Vue d\'ensemble de l\'activité formation')

@section('formation-content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total_modules'] ?? 0 }}</h3>
                <p>Modules de formation</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder"></i>
            </div>
            <a href="{{ route('back.formation.modules.index') }}" class="small-box-footer">
                Voir détails <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['total_cours'] ?? 0 }}</h3>
                <p>Cours disponibles</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="{{ route('back.formation.cours.index') }}" class="small-box-footer">
                Voir détails <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['total_inscriptions_validees'] ?? 0 }}</h3>
                <p>Inscriptions actives</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('back.formation.inscriptions.index') }}" class="small-box-footer">
                Voir détails <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['total_soumissions_non_corrigees'] ?? 0 }}</h3>
                <p>Devoirs à corriger</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <a href="{{ route('back.formation.soumissions.a-corriger') }}" class="small-box-footer">
                Voir détails <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Évolution des inscriptions
                </h3>
            </div>
            <div class="card-body">
                <canvas id="inscriptionsChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-2"></i>
                    Répartition par niveau
                </h3>
            </div>
            <div class="card-body">
                <canvas id="coursChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clock mr-2"></i>
                    Derniers cours ajoutés
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Module</th>
                                <th>Niveau</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($derniersCours ?? [] as $cour)
                            <tr>
                                <td>{{ $cour->titre }}</td>
                                <td>{{ $cour->module->titre ?? 'N/A' }}</td>
                                <td>
                                    @include('back.formation.partials.status-badge', ['status' => $cour->niveau_difficulte])
                                </td>
                                <td>{{ $cour->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('back.formation.cours.show', $cour) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun cours trouvé</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple mr-2"></i>
                    Progression des modules
                </h3>
            </div>
            <div class="card-body">
                @forelse($progressionsParModule ?? [] as $progression)
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>{{ $progression['module'] }}</span>
                        <span class="font-weight-bold">{{ round($progression['progression_moyenne'], 1) }}%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: {{ $progression['progression_moyenne'] }}%"></div>
                    </div>
                    <small class="text-muted">{{ $progression['nb_inscrits'] }} inscrits</small>
                </div>
                @empty
                <div class="alert alert-info">
                    Aucune donnée de progression disponible.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tasks mr-2"></i>
                    Devoirs en attente de correction
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Devoir</th>
                                <th>Cours</th>
                                <th>À corriger</th>
                                <th>Date limite</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($devoirsACorriger ?? [] as $item)
                            <tr>
                                <td>{{ $item['devoir']->titre }}</td>
                                <td>{{ $item['devoir']->cour->titre ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-danger">{{ $item['a_corriger'] }}</span>
                                </td>
                                <td>
                                    @if($item['devoir']->date_limite)
                                        {{ \Carbon\Carbon::parse($item['devoir']->date_limite)->format('d/m/Y H:i') }}
                                    @else
                                        <span class="text-muted">Aucune</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('back.formation.soumissions.a-corriger') }}?devoir={{ $item['devoir']->id }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-check-double"></i> Corriger
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun devoir en attente de correction</td>
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
        // Graphique des inscriptions
        var ctx1 = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: {!! json_encode($evolutionInscriptions->pluck('date')->map(function($date) { 
                    return \Carbon\Carbon::parse($date)->format('d/m'); 
                })) !!},
                datasets: [{
                    label: 'Inscriptions',
                    data: {!! json_encode($evolutionInscriptions->pluck('total')) !!},
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
        
        // Graphique des cours par niveau
        var ctx2 = document.getElementById('coursChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($repartitionNiveaux->pluck('niveau_difficulte')->map(function($niveau) {
                    $labels = ['debutant' => 'Débutant', 'intermediaire' => 'Intermédiaire', 'avance' => 'Avancé', 'expert' => 'Expert'];
                    return $labels[$niveau] ?? $niveau;
                })) !!},
                datasets: [{
                    data: {!! json_encode($repartitionNiveaux->pluck('total')) !!},
                    backgroundColor: ['#28a745', '#ffc107', '#fd7e14', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endpush