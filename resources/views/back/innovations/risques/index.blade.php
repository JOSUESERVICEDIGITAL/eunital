@extends('back.layouts.principal')

@section('title', 'Risques de réforme')
@section('page_title', 'Risques')
@section('page_subtitle', 'Suivi des risques, niveaux de criticité et mesures de mitigation.')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Risques</h4>
            <p class="text-muted mb-0">Risques liés aux réformes internes.</p>
        </div>

        <a href="{{ route('back.innovations.risques.create') }}" class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-plus me-2"></i>Nouveau risque
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Risque</th>
                    <th>Réforme</th>
                    <th>Niveau</th>
                    <th>Mitigation</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($risques as $risque)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $risque->titre }}</div>
                            <small class="text-muted">{{ Str::limit($risque->description, 80) }}</small>
                        </td>
                        <td>{{ optional($risque->reforme)->titre ?? '—' }}</td>
                        <td>
                            <span class="badge rounded-pill bg-danger-subtle text-danger">
                                {{ $risque->niveau }}
                            </span>
                        </td>
                        <td>{{ Str::limit($risque->mesure_mitigation ?? '—', 80) }}</td>
                        <td class="text-end">
                            <a href="{{ route('back.innovations.risques.show', $risque) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                            <a href="{{ route('back.innovations.risques.edit', $risque) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Aucun risque.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $risques->links() }}
    </div>
</div>

@include('back.innovations.risques._styles')
@endsection