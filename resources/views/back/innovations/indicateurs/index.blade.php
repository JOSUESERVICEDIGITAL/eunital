@extends('back.layouts.principal')

@section('title', 'Indicateurs innovation')
@section('page_title', 'Indicateurs')
@section('page_subtitle', 'KPI, valeurs de référence, cibles et valeurs actuelles.')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Indicateurs</h4>
            <p class="text-muted mb-0">Mesure de performance des innovations.</p>
        </div>

        <a href="{{ route('back.innovations.indicateurs.create') }}" class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-plus me-2"></i>Nouvel indicateur
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Indicateur</th>
                    <th>Innovation</th>
                    <th>Unité</th>
                    <th>Référence</th>
                    <th>Cible</th>
                    <th>Actuelle</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($indicateurs as $indicateur)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $indicateur->nom }}</div>
                            <small class="text-muted">{{ Str::limit($indicateur->description, 70) }}</small>
                        </td>
                        <td>{{ optional($indicateur->innovation)->titre ?? '—' }}</td>
                        <td>{{ $indicateur->unite ?? '—' }}</td>
                        <td>{{ $indicateur->valeur_reference ?? '—' }}</td>
                        <td>{{ $indicateur->valeur_cible ?? '—' }}</td>
                        <td>
                            <span class="badge rounded-pill bg-warning-subtle text-warning">
                                {{ $indicateur->valeur_actuelle ?? '—' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('back.innovations.indicateurs.show', $indicateur) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                            <a href="{{ route('back.innovations.indicateurs.edit', $indicateur) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Aucun indicateur.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $indicateurs->links() }}
    </div>
</div>

@include('back.innovations.indicateurs._styles')
@endsection
