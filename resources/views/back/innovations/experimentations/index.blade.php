@extends('back.layouts.principal')

@section('title', 'Expérimentations')
@section('page_title', 'Expérimentations')
@section('page_subtitle', 'Tests terrain, pilotes, résultats et décisions.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Expérimentations</h4>
                <p class="text-muted mb-0">Laboratoire terrain des innovations avant déploiement.</p>
            </div>

            <a href="{{ route('back.innovations.experimentations.create') }}" class="btn btn-warning rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i>Nouvelle expérimentation
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
            <form method="GET" action="{{ route('back.innovations.experimentations.index') }}">
                <div class="row g-3">
                    <div class="col-md-5">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control hub-input" placeholder="Recherche...">
                    </div>

                    <div class="col-md-3">
                        <select name="statut" class="form-select hub-input">
                            <option value="">Tous statuts</option>
                            @foreach(['planifiee','en_cours','terminee','suspendue','abandonnee'] as $s)
                                <option value="{{ $s }}" @selected(request('statut') === $s)>
                                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button class="btn btn-primary rounded-pill px-4">Filtrer</button>
                        <a href="{{ route('back.innovations.experimentations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Reset</a>
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
                            <th>Expérimentation</th>
                            <th>Innovation</th>
                            <th>Responsable</th>
                            <th>Statut</th>
                            <th>Sites</th>
                            <th>Résultats</th>
                            <th>Décisions</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($experimentations as $experimentation)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $experimentation->titre }}</div>
                                    <small class="text-muted">{{ Str::limit($experimentation->hypothese, 60) }}</small>
                                </td>
                                <td>{{ optional($experimentation->innovation)->titre ?? '—' }}</td>
                                <td>{{ optional($experimentation->responsable)->name ?? '—' }}</td>
                                <td><span class="badge rounded-pill bg-info-subtle text-info">{{ str_replace('_', ' ', $experimentation->statut) }}</span></td>
                                <td>{{ $experimentation->sites_count }}</td>
                                <td>{{ $experimentation->resultats_count }}</td>
                                <td>{{ $experimentation->decisions_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.experimentations.show', $experimentation) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                    <a href="{{ route('back.innovations.experimentations.edit', $experimentation) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">Aucune expérimentation trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $experimentations->links() }}</div>
        </div>
    </div>

</div>

@include('back.innovations.experimentations._styles')
@endsection
