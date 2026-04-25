@extends('back.layouts.principal')

@section('title', 'Actions de réforme')
@section('page_title', 'Actions')
@section('page_subtitle', 'Pilotage des actions liées aux réformes internes.')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Actions</h4>
            <p class="text-muted mb-0">Suivi des actions, responsables, échéances et statuts.</p>
        </div>

        <a href="{{ route('back.innovations.actions.create') }}" class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-plus me-2"></i>Nouvelle action
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Réforme</th>
                    <th>Responsable</th>
                    <th>Début</th>
                    <th>Échéance</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($actions as $action)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $action->titre }}</div>
                            <small class="text-muted">{{ Str::limit($action->description, 80) }}</small>
                        </td>
                        <td>{{ optional($action->reforme)->titre ?? '—' }}</td>
                        <td>{{ optional($action->responsable)->name ?? '—' }}</td>
                        <td>{{ optional($action->date_debut)->format('d/m/Y') ?? '—' }}</td>
                        <td>{{ optional($action->date_echeance)->format('d/m/Y') ?? '—' }}</td>
                        <td>
                            <span class="badge rounded-pill bg-info-subtle text-info">
                                {{ str_replace('_', ' ', $action->statut) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('back.innovations.actions.show', $action) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                            <a href="{{ route('back.innovations.actions.edit', $action) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Aucune action.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $actions->links() }}
    </div>
</div>

@include('back.innovations.actions._styles')
@endsection
