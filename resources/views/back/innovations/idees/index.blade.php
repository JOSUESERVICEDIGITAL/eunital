@extends('back.layouts.principal')

@section('title', 'Boîte à idées')
@section('page_title', 'Boîte à idées')
@section('page_subtitle', 'Collecte, tri et maturation des idées d’innovation.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Idées d’innovation</h4>
                <p class="text-muted mb-0">Réservoir national des idées internes, citoyennes et institutionnelles.</p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('back.innovations.idees.shortlist') }}" class="btn btn-outline-primary rounded-pill px-4">
                    Shortlist
                </a>
                <a href="{{ route('back.innovations.idees.create') }}" class="btn btn-warning rounded-pill px-4">
                    <i class="fa-solid fa-plus me-2"></i>Nouvelle idée
                </a>
            </div>
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
            <form method="GET" action="{{ route('back.innovations.idees.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control hub-input" placeholder="Rechercher une idée...">
                    </div>

                    <div class="col-md-2">
                        <select name="statut" class="form-select hub-input">
                            <option value="">Tous statuts</option>
                            @foreach(['soumise','en_etude','retenue','rejetee','transformee_en_innovation'] as $s)
                                <option value="{{ $s }}" @selected(request('statut') === $s)>
                                    {{ ucfirst(str_replace('_',' ',$s)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="origine" class="form-select hub-input">
                            <option value="">Toutes origines</option>
                            @foreach(['interne','citoyen','partenaire','institution'] as $o)
                                <option value="{{ $o }}" @selected(request('origine') === $o)>{{ ucfirst($o) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="niveau_maturite" class="form-select hub-input">
                            <option value="">Toutes maturités</option>
                            @foreach(['idee','concept','prototype','pret'] as $m)
                                <option value="{{ $m }}" @selected(request('niveau_maturite') === $m)>{{ ucfirst($m) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button class="btn btn-primary rounded-pill px-4">Filtrer</button>
                        <a href="{{ route('back.innovations.idees.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Reset</a>
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
                            <th>Idée</th>
                            <th>Origine</th>
                            <th>Maturité</th>
                            <th>Impact</th>
                            <th>Faisabilité</th>
                            <th>Statut</th>
                            <th>Votes</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($idees as $idee)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $idee->titre }}</div>
                                    <div class="text-muted small">{{ $idee->categorie ?? 'Sans catégorie' }}</div>
                                </td>
                                <td>{{ $idee->origine }}</td>
                                <td><span class="badge rounded-pill text-bg-light border">{{ $idee->niveau_maturite }}</span></td>
                                <td><span class="badge rounded-pill bg-warning-subtle text-warning">{{ $idee->impact_potentiel }}</span></td>
                                <td>{{ $idee->faisabilite }}</td>
                                <td><span class="badge rounded-pill bg-info-subtle text-info">{{ str_replace('_',' ',$idee->statut) }}</span></td>
                                <td>{{ $idee->votes_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.idees.show', $idee) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                    <a href="{{ route('back.innovations.idees.edit', $idee) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">Aucune idée trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $idees->links() }}
            </div>
        </div>
    </div>

</div>

@include('back.innovations.idees._styles')
@endsection
