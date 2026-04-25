@extends('back.layouts.principal')

@section('title', 'Réformes internes')
@section('page_title', 'Réformes internes')
@section('page_subtitle', 'Pilotage des réformes, actions, risques et décisions.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Réformes internes</h4>
                <p class="text-muted mb-0">Chantiers de modernisation, amélioration structurelle et transformation interne.</p>
            </div>

            <a href="{{ route('back.innovations.reformes.create') }}" class="btn btn-warning rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i>Nouvelle réforme
            </a>
        </div>
    </div>

    @foreach($stats as $label => $value)
        <div class="col-md-2">
            <div class="mini-stat-card">
                <span>{{ ucfirst(str_replace('_', ' ', $label)) }}</span>
                <strong>{{ $value }}</strong>
            </div>
        </div>
    @endforeach

    <div class="col-12">
        <div class="content-card">
            <form method="GET" action="{{ route('back.innovations.reformes.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control hub-input" placeholder="Recherche...">
                    </div>

                    <div class="col-md-3">
                        <select name="statut" class="form-select hub-input">
                            <option value="">Tous statuts</option>
                            @foreach(['brouillon','planifiee','en_cours','suspendue','terminee','archivee'] as $s)
                                <option value="{{ $s }}" @selected(request('statut') === $s)>
                                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="niveau_priorite" class="form-select hub-input">
                            <option value="">Toutes priorités</option>
                            @foreach(['faible','moyenne','haute','critique'] as $p)
                                <option value="{{ $p }}" @selected(request('niveau_priorite') === $p)>
                                    {{ ucfirst($p) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary rounded-pill px-4 w-100">Filtrer</button>
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
                            <th>Réforme</th>
                            <th>Domaine</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                            <th>Responsable</th>
                            <th>Actions</th>
                            <th>Risques</th>
                            <th class="text-end">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reformes as $reforme)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $reforme->titre }}</div>
                                    <small class="text-muted">{{ $reforme->code }}</small>
                                </td>
                                <td>{{ $reforme->domaine ?? '—' }}</td>
                                <td><span class="badge rounded-pill bg-info-subtle text-info">{{ str_replace('_', ' ', $reforme->statut) }}</span></td>
                                <td><span class="badge rounded-pill bg-warning-subtle text-warning">{{ $reforme->niveau_priorite }}</span></td>
                                <td>{{ optional($reforme->responsable)->name ?? '—' }}</td>
                                <td>{{ $reforme->actions_count }}</td>
                                <td>{{ $reforme->risques_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.reformes.show', $reforme) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                    <a href="{{ route('back.innovations.reformes.edit', $reforme) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">Aucune réforme trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $reformes->links() }}
            </div>
        </div>
    </div>

</div>

@include('back.innovations.reformes._styles')
@endsection
