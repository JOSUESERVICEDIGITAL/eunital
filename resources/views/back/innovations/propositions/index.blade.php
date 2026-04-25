@extends('back.layouts.principal')

@section('title', 'Propositions')
@section('page_title', 'Propositions d’amélioration')
@section('page_subtitle', 'Collecte, analyse et décision des propositions internes et externes.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Propositions</h4>
                <p class="text-muted mb-0">Entrées du système d’amélioration continue.</p>
            </div>

            <a href="{{ route('back.innovations.propositions.create') }}" class="btn btn-warning rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i>Nouvelle proposition
            </a>
        </div>
    </div>

    @foreach($stats as $label => $value)
        <div class="col-md-2">
            <div class="mini-stat-card text-center">
                <span>{{ ucfirst(str_replace('_',' ',$label)) }}</span>
                <strong>{{ $value }}</strong>
            </div>
        </div>
    @endforeach

    <div class="col-12">
        <div class="content-card">
            <div class="table-responsive">
                <table class="table hub-table align-middle">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Origine</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                            <th>Décideur</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($propositions as $p)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $p->titre }}</div>
                                    <small class="text-muted">{{ $p->code }}</small>
                                </td>
                                <td>{{ $p->origine }}</td>
                                <td><span class="badge bg-info-subtle text-info">{{ $p->statut }}</span></td>
                                <td><span class="badge bg-warning-subtle text-warning">{{ $p->niveau_priorite }}</span></td>
                                <td>{{ optional($p->decideur)->name ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.propositions.show',$p) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">Aucune proposition</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $propositions->links() }}
        </div>
    </div>

</div>

@include('back.innovations.propositions._styles')
@endsection
