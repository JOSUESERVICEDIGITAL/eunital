@extends('back.layouts.principal')

@section('title', 'Portefeuilles innovation')
@section('page_title', 'Portefeuilles innovation')
@section('page_subtitle', 'Organisation stratégique des programmes, chantiers et initiatives de transformation.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h4 class="fw-bold mb-1">Portefeuilles stratégiques</h4>
                    <p class="text-muted mb-0">Classe les innovations par programme national, secteur, région ou ministère.</p>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.innovations.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-gauge-high me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('back.innovations.portefeuilles.create') }}" class="btn btn-warning rounded-pill px-4">
                        <i class="fa-solid fa-plus me-2"></i>Nouveau portefeuille
                    </a>
                </div>
            </div>
        </div>
    </div>

    @php
        $cards = [
            ['label' => 'Total', 'value' => $stats['total'] ?? 0, 'class' => 'warning', 'icon' => 'fa-layer-group'],
            ['label' => 'Actifs', 'value' => $stats['actifs'] ?? 0, 'class' => 'success', 'icon' => 'fa-circle-check'],
            ['label' => 'Suspendus', 'value' => $stats['suspendus'] ?? 0, 'class' => 'danger', 'icon' => 'fa-pause'],
            ['label' => 'Archivés', 'value' => $stats['archives'] ?? 0, 'class' => 'secondary', 'icon' => 'fa-box-archive'],
        ];
    @endphp

    @foreach($cards as $card)
        <div class="col-md-3">
            <div class="mini-stat-card">
                <div>
                    <span>{{ $card['label'] }}</span>
                    <strong>{{ $card['value'] }}</strong>
                </div>
                <div class="mini-stat-icon {{ $card['class'] }}">
                    <i class="fa-solid {{ $card['icon'] }}"></i>
                </div>
            </div>
        </div>
    @endforeach

    <div class="col-12">
        <div class="content-card">
            <form method="GET" action="{{ route('back.innovations.portefeuilles.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control hub-input"
                               placeholder="Nom, code, description...">
                    </div>

                    <div class="col-md-2">
                        <select name="type_portefeuille" class="form-select hub-input">
                            <option value="">Tous types</option>
                            @foreach(['national','ministeriel','regional','sectoriel'] as $type)
                                <option value="{{ $type }}" @selected(request('type_portefeuille') === $type)>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="statut" class="form-select hub-input">
                            <option value="">Tous statuts</option>
                            @foreach(['actif','suspendu','archive'] as $statut)
                                <option value="{{ $statut }}" @selected(request('statut') === $statut)>
                                    {{ ucfirst($statut) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="niveau_priorite" class="form-select hub-input">
                            <option value="">Toutes priorités</option>
                            @foreach(['faible','moyenne','haute','critique'] as $priorite)
                                <option value="{{ $priorite }}" @selected(request('niveau_priorite') === $priorite)>
                                    {{ ucfirst($priorite) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex flex-wrap gap-2">
                        <button class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-filter me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('back.innovations.portefeuilles.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <div class="table-responsive">
                <table class="table align-middle hub-table">
                    <thead>
                        <tr>
                            <th>Portefeuille</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                            <th>Responsable</th>
                            <th>Innovations</th>
                            <th>Budget</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($portefeuilles as $portefeuille)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $portefeuille->nom }}</div>
                                    <div class="text-muted small">{{ $portefeuille->code }}</div>
                                </td>
                                <td><span class="badge rounded-pill text-bg-light border">{{ $portefeuille->type_portefeuille }}</span></td>
                                <td><span class="badge rounded-pill bg-info-subtle text-info">{{ $portefeuille->statut }}</span></td>
                                <td><span class="badge rounded-pill bg-warning-subtle text-warning">{{ $portefeuille->niveau_priorite }}</span></td>
                                <td>{{ optional($portefeuille->responsable)->name ?? '—' }}</td>
                                <td>{{ $portefeuille->innovations_count }}</td>
                                <td>
                                    <div class="fw-bold">{{ number_format($portefeuille->budget_consomme, 0, ',', ' ') }}</div>
                                    <div class="text-muted small">/ {{ number_format($portefeuille->budget_previsionnel, 0, ',', ' ') }}</div>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('back.innovations.portefeuilles.show', $portefeuille) }}" class="btn btn-sm btn-light rounded-pill">
                                            Voir
                                        </a>
                                        <a href="{{ route('back.innovations.portefeuilles.budget', $portefeuille) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Budget
                                        </a>
                                        <a href="{{ route('back.innovations.portefeuilles.edit', $portefeuille) }}" class="btn btn-sm btn-warning rounded-pill">
                                            Modifier
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">Aucun portefeuille trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $portefeuilles->links() }}
            </div>
        </div>
    </div>

</div>

@include('back.innovations.portefeuilles._styles')
@endsection
