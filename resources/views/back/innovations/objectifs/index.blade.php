@extends('back.layouts.principal')

@section('title', 'Objectifs innovation')
@section('page_title', 'Objectifs')
@section('page_subtitle', 'Suivi des objectifs liés aux innovations.')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Objectifs</h4>
            <p class="text-muted mb-0">Cibles, valeurs actuelles et statut d’atteinte.</p>
        </div>

        <a href="{{ route('back.innovations.objectifs.create') }}" class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-plus me-2"></i>Nouvel objectif
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Objectif</th>
                    <th>Innovation</th>
                    <th>Cible</th>
                    <th>Actuelle</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objectifs as $objectif)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $objectif->titre }}</div>
                            <small class="text-muted">{{ Str::limit($objectif->description, 70) }}</small>
                        </td>
                        <td>{{ optional($objectif->innovation)->titre ?? '—' }}</td>
                        <td>{{ $objectif->valeur_cible ?? '—' }}</td>
                        <td>{{ $objectif->valeur_actuelle ?? '—' }}</td>
                        <td>
                            <span class="badge rounded-pill bg-info-subtle text-info">
                                {{ str_replace('_', ' ', $objectif->statut) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('back.innovations.objectifs.show', $objectif) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                            <a href="{{ route('back.innovations.objectifs.edit', $objectif) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Aucun objectif.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $objectifs->links() }}
    </div>
</div>

@include('back.innovations.objectifs._styles')
@endsection
