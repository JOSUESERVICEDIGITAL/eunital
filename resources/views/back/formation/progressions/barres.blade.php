@extends('back.formation.layouts.app')

@section('title', 'Barres de progression')
@section('page_title', 'Barres de progression')
@section('page_subtitle', 'Visualisation graphique des progressions')

@section('formation-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple mr-2"></i>
                    Progression globale
                </h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="easypiechart" data-percent="{{ $stats['global'] }}" style="width: 200px; margin: 0 auto;">
                        <span class="h2">{{ round($stats['global'], 1) }}%</span>
                    </div>
                    <p class="mt-2 text-muted">Progression moyenne de tous les apprenants</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Top 10 des cours par progression
                </h3>
            </div>
            <div class="card-body">
                @foreach($stats['par_cours'] as $cours)
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>{{ $cours['cour'] }}</span>
                        <span class="font-weight-bold">{{ $cours['progression'] }}%</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: {{ $cours['progression'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-trophy mr-2"></i>
                    Top 10 des apprenants par progression
                </h3>
            </div>
            <div class="card-body">
                @foreach($stats['par_utilisateur'] as $user)
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>{{ $user['user'] }}</span>
                        <span class="font-weight-bold">{{ $user['progression'] }}%</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success" style="width: {{ $user['progression'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-2"></i>
                    Répartition des statuts
                </h3>
            </div>
            <div class="card-body">
                <canvas id="statusChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .easypiechart {
        position: relative;
        text-align: center;
    }
    .easypiechart .h2 {
        margin-left: 10px;
        margin-top: 10px;
        display: inline-block;
        height: 180px;
        width: 180px;
        text-align: center;
        border: 8px solid #f4f4f4;
        border-radius: 50%;
        line-height: 164px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/easy-pie-chart@2.1.6/dist/jquery.easypiechart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $('.easypiechart').easyPieChart({
            scaleColor: false,
            trackColor: '#f4f4f4',
            barColor: '#007bff',
            lineWidth: 10,
            size: 200,
            animate: 1000
        });
        
        @php
            $termines = \App\Models\Formation\Progression::where('termine', true)->count();
            $enCours = \App\Models\Formation\Progression::where('termine', false)->where('progression', '>', 0)->count();
            $nonCommences = \App\Models\Formation\Progression::where('progression', 0)->count();
        @endphp
        
        var ctx = document.getElementById('statusChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Terminés ({{ $termines }})', 'En cours ({{ $enCours }})', 'Non commencés ({{ $nonCommences }})'],
                datasets: [{
                    data: [{{ $termines }}, {{ $enCours }}, {{ $nonCommences }}],
                    backgroundColor: ['#28a745', '#ffc107', '#6c757d']
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