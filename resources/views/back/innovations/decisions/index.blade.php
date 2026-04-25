@extends('back.layouts.principal')

@section('title', 'Décisions')
@section('page_title', 'Décisions')
@section('page_subtitle', 'Suivi des décisions liées aux réformes et innovations.')

@section('content')
<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Décisions</h4>
            <p class="text-muted mb-0">Historique et validation des décisions.</p>
        </div>

        <a href="{{ route('back.innovations.decisions.create') }}" class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-plus me-2"></i>Nouvelle décision
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Décision</th>
                    <th>Réforme</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($decisions as $decision)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $decision->titre }}</div>
                            <small class="text-muted">{{ Str::limit($decision->decision, 80) }}</small>
                        </td>
                        <td>{{ optional($decision->reforme)->titre ?? '—' }}</td>
                        <td>{{ optional($decision->auteur)->name ?? '—' }}</td>
                        <td>{{ optional($decision->date_decision)->format('d/m/Y') ?? '—' }}</td>
                        <td>
                            <span class="badge bg-info-subtle text-info">
                                {{ $decision->statut }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('back.innovations.decisions.show', $decision) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                            <a href="{{ route('back.innovations.decisions.edit', $decision) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Aucune décision.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $decisions->links() }}

</div>

@include('back.innovations.decisions._styles')
@endsection
