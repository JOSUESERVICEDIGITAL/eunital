@extends('back.layouts.principal')

@section('title', 'Innovations')
@section('page_title', 'Innovations')
@section('page_subtitle', 'Pilotage des innovations, statuts, priorités, portefeuilles et avancement.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h4 class="fw-bold mb-1">Toutes les innovations</h4>
                    <p class="text-muted mb-0">Vue centrale des projets d’innovation du hub.</p>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.innovations.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-gauge-high me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('back.innovations.innovations.create') }}" class="btn btn-warning rounded-pill px-4">
                        <i class="fa-solid fa-plus me-2"></i>Nouvelle innovation
                    </a>
                </div>
            </div>
        </div>
    </div>

    @php
        $cards = [
            ['label' => 'Total', 'value' => $stats['total'] ?? 0, 'icon' => 'fa-lightbulb', 'class' => 'warning'],
            ['label' => 'En cours', 'value' => $stats['en_cours'] ?? 0, 'icon' => 'fa-spinner', 'class' => 'info'],
            ['label' => 'Pilotes', 'value' => $stats['pilotes'] ?? 0, 'icon' => 'fa-flask', 'class' => 'purple'],
            ['label' => 'Déployées', 'value' => $stats['deployees'] ?? 0, 'icon' => 'fa-map-location-dot', 'class' => 'success'],
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
            <form method="GET" action="{{ route('back.innovations.innovations.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control hub-input" placeholder="Recherche...">
                    </div>

                    <div class="col-md-2">
                        <select name="statut" class="form-select hub-input">
                            <option value="">Tous statuts</option>
                            @foreach(['brouillon','en_etude','en_cours','en_pilote','deployee','suspendue','terminee','archivee'] as $statut)
                                <option value="{{ $statut }}" @selected(request('statut') === $statut)>
                                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="type_innovation" class="form-select hub-input">
                            <option value="">Tous types</option>
                            @foreach(['digitale','organisationnelle','sociale','territoriale','technique'] as $type)
                                <option value="{{ $type }}" @selected(request('type_innovation') === $type)>
                                    {{ ucfirst($type) }}
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

                    <div class="col-md-3 d-flex gap-2">
                        <button class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-filter me-2"></i>Filtrer
                        </button>
                        <a href="{{ route('back.innovations.innovations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
                            <th>Innovation</th>
                            <th>Portefeuille</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                            <th>Responsable</th>
                            <th>Modules</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($innovations as $innovation)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $innovation->titre }}</div>
                                    <div class="text-muted small">{{ $innovation->code }}</div>
                                </td>
                                <td>{{ optional($innovation->portefeuille)->nom ?? '—' }}</td>
                                <td><span class="badge rounded-pill text-bg-light border">{{ $innovation->type_innovation }}</span></td>
                                <td><span class="badge rounded-pill bg-info-subtle text-info">{{ str_replace('_', ' ', $innovation->statut) }}</span></td>
                                <td><span class="badge rounded-pill bg-warning-subtle text-warning">{{ $innovation->niveau_priorite }}</span></td>
                                <td>{{ optional($innovation->responsable)->name ?? '—' }}</td>
                                <td>
                                    <span class="small text-muted">
                                        Obj: {{ $innovation->objectifs_count }} |
                                        KPI: {{ $innovation->indicateurs_count }} |
                                        Suivis: {{ $innovation->suivis_count }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('back.innovations.innovations.show', $innovation) }}" class="btn btn-sm btn-light rounded-pill">
                                            Voir
                                        </a>
                                        <a href="{{ route('back.innovations.innovations.edit', $innovation) }}" class="btn btn-sm btn-warning rounded-pill">
                                            Modifier
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">Aucune innovation trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $innovations->links() }}
            </div>
        </div>
    </div>
</div>

@include('back.innovations.innovations._styles')
@endsection
