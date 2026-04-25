@extends('back.layouts.principal')

@section('title', 'Actions réforme')
@section('page_title', 'Actions de réforme')
@section('page_subtitle', $reforme->titre)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Actions</h4>
            <p>Plan d’action de la réforme.</p>
        </div>
        <a href="{{ route('back.innovations.reformes.show', $reforme) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Responsable</th>
                    <th>Début</th>
                    <th>Échéance</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reforme->actions as $action)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $action->titre }}</div>
                            <small class="text-muted">{{ $action->description }}</small>
                        </td>
                        <td>{{ optional($action->responsable)->name ?? '—' }}</td>
                        <td>{{ optional($action->date_debut)->format('d/m/Y') ?? '—' }}</td>
                        <td>{{ optional($action->date_echeance)->format('d/m/Y') ?? '—' }}</td>
                        <td><span class="badge bg-info-subtle text-info">{{ $action->statut }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Aucune action.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('back.innovations.reformes._styles')
@endsection
