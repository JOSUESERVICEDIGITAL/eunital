@extends('back.layouts.principal')

@section('title', 'Partenariats innovation')
@section('page_title', 'Partenariats')
@section('page_subtitle', 'Partenaires, apports, conventions et collaborations autour des innovations.')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Partenariats</h4>
            <p class="text-muted mb-0">Suivi des partenaires institutionnels, techniques et financiers.</p>
        </div>

        <a href="{{ route('back.innovations.partenariats.create') }}" class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-plus me-2"></i>Nouveau partenariat
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Partenaire</th>
                    <th>Innovation</th>
                    <th>Type</th>
                    <th>Contribution</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partenariats as $partenariat)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $partenariat->nom_partenaire ?? $partenariat->nom ?? '—' }}</div>
                            <small class="text-muted">{{ $partenariat->contact ?? 'Contact non défini' }}</small>
                        </td>
                        <td>{{ optional($partenariat->innovation)->titre ?? '—' }}</td>
                        <td><span class="badge rounded-pill bg-light text-dark border">{{ $partenariat->type_partenaire ?? '—' }}</span></td>
                        <td>{{ Str::limit($partenariat->contribution ?? '—', 60) }}</td>
                        <td><span class="badge rounded-pill bg-info-subtle text-info">{{ $partenariat->statut ?? 'actif' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('back.innovations.partenariats.show', $partenariat) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                            <a href="{{ route('back.innovations.partenariats.edit', $partenariat) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Aucun partenariat enregistré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $partenariats->links() }}
    </div>
</div>

@include('back.innovations.partenariats._styles')
@endsection
