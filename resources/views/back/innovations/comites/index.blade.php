@extends('back.layouts.principal')

@section('title', 'Comités innovation')
@section('page_title', 'Comités innovation')
@section('page_subtitle', 'Gouvernance, arbitrage, validation et décisions stratégiques.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Comités</h4>
                <p class="text-muted mb-0">Instances de validation, pilotage et arbitrage des innovations.</p>
            </div>

            <a href="{{ route('back.innovations.comites.create') }}" class="btn btn-warning rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i>Nouveau comité
            </a>
        </div>
    </div>

    @foreach($stats ?? [] as $label => $value)
        <div class="col-md-3">
            <div class="mini-stat-card">
                <span>{{ ucfirst(str_replace('_',' ', $label)) }}</span>
                <strong>{{ $value }}</strong>
            </div>
        </div>
    @endforeach

    <div class="col-12">
        <div class="content-card">
            <div class="table-responsive">
                <table class="table align-middle hub-table">
                    <thead>
                        <tr>
                            <th>Comité</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Sessions</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comites as $comite)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $comite->nom }}</div>
                                    <small class="text-muted">{{ Str::limit($comite->description, 80) }}</small>
                                </td>
                                <td><span class="badge rounded-pill bg-light text-dark border">{{ $comite->type_comite }}</span></td>
                                <td><span class="badge rounded-pill bg-info-subtle text-info">{{ $comite->statut }}</span></td>
                                <td>{{ $comite->sessions_count ?? $comite->sessions->count() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.comites.show', $comite) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                    <a href="{{ route('back.innovations.comites.edit', $comite) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Aucun comité.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $comites->links() }}
            </div>
        </div>
    </div>

</div>

@include('back.innovations.comites._styles')
@endsection
