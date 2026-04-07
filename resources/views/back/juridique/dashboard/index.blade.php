@extends('back.juridique.layouts.app')

@section('title', 'Dashboard Juridique')
@section('page_title', 'Tableau de bord')
@section('page_subtitle', 'Vue d\'ensemble de l\'activité juridique')

@section('juridique-content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total_documents'] ?? 0 }}</h3>
                <p>Documents</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-contract"></i>
            </div>
            <a href="{{ route('back.juridique.documents.index') }}" class="small-box-footer">
                Voir détails <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['total_contrats'] ?? 0 }}</h3>
                <p>Contrats actifs</p>
            </div>
            <div class="icon">
                <i class="fas fa-handshake"></i>
            </div>
            <a href="{{ route('back.juridique.contrats.actifs') }}" class="small-box-footer">
                Voir détails <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['signatures_attendues'] ?? 0 }}</h3>
                <p>Signatures attendues</p>
            </div>
            <div class="icon">
                <i class="fas fa-pen"></i>
            </div>
            <a href="{{ route('back.juridique.signatures.en-attente') }}" class="small-box-footer">
                Voir détails <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['litiges_ouverts'] ?? 0 }}</h3>
                <p>Litiges ouverts</p>
            </div>
            <div class="icon">
                <i class="fas fa-gavel"></i>
            </div>
            <a href="{{ route('back.juridique.litiges.ouverts') }}" class="small-box-footer">
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
                    Évolution des documents
                </h3>
            </div>
            <div class="card-body">
                <canvas id="evolutionChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-2"></i>
                    Répartition par type
                </h3>
            </div>
            <div class="card-body">
                <canvas id="typeChart" style="height: 300px;"></canvas>
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
                    Derniers documents
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                             <tr>
                                <th>Document</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Date</th>
                             </tr>
                        </thead>
                        <tbody>
                            @forelse($derniersDocuments ?? [] as $doc)
                            <tr>
                                <td><a href="{{ route('back.juridique.documents.show', $doc) }}">{{ $doc->titre }}</a></td>
                                <td>{{ $doc->typeDocument->nom ?? '-' }}</td>
                                <td>@include('back.juridique.partials.status-badge', ['status' => $doc->statut])</td>
                                <td>{{ $doc->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">Aucun document</td></tr>
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
                    <i class="fas fa-tasks mr-2"></i>
                    Signatures en attente
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                             <tr>
                                <th>Document</th>
                                <th>Signataire</th>
                                <th>Type</th>
                                <th>Date</th>
                             </tr>
                        </thead>
                        <tbody>
                            @forelse($signaturesEnAttente ?? [] as $signature)
                            <tr>
                                <td><a href="{{ route('back.juridique.documents.show', $signature->document) }}">{{ $signature->document->titre }}</a></td>
                                <td>{{ $signature->user->name }}</td>
                                <td>{{ $signature->type_signataire_label }}</td>
                                <td>{{ $signature->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">Aucune signature en attente</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple mr-2"></i>
                    Indicateurs clés
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary"><i class="fas fa-percent"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Taux de conformité</span>
                                <span class="info-box-number">{{ $stats['taux_conformite'] ?? 0 }}%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-euro-sign"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Valeur contrats</span>
                                <span class="info-box-number">{{ number_format($stats['valeur_contrats'] ?? 0, 2) }} €</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Documents/jour</span>
                                <span class="info-box-number">{{ $stats['documents_par_jour'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fas fa-gavel"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Coût litiges</span>
                                <span class="info-box-number">{{ number_format($stats['cout_litiges'] ?? 0, 2) }} €</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('juridique-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique d'évolution
    var ctx1 = document.getElementById('evolutionChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: {!! json_encode($evolutionDocuments->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d/m'))) !!},
            datasets: [{
                label: 'Documents',
                data: {!! json_encode($evolutionDocuments->pluck('total')) !!},
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Graphique des types
    var ctx2 = document.getElementById('typeChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($documentsParType->pluck('type')) !!},
            datasets: [{
                data: {!! json_encode($documentsParType->pluck('total')) !!},
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6f42c1']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush
