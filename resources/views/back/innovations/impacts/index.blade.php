@extends('back.layouts.principal')

@section('title', 'Impacts innovation')
@section('page_title', 'Impacts')
@section('page_subtitle', 'Mesure des résultats, bénéficiaires, indicateurs et preuves d’impact.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Impacts mesurés</h4>
                <p class="text-muted mb-0">Suivi des effets produits par les innovations.</p>
            </div>

            <a href="{{ route('back.innovations.impacts.create') }}" class="btn btn-warning rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i>Nouvel impact
            </a>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <div class="table-responsive">
                <table class="table align-middle hub-table">
                    <thead>
                        <tr>
                            <th>Innovation</th>
                            <th>Type impact</th>
                            <th>Période</th>
                            <th>Avant</th>
                            <th>Après</th>
                            <th>Variation</th>
                            <th>Mesures</th>
                            <th>Bénéficiaires</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($impacts as $impact)
                            <tr>
                                <td class="fw-bold">{{ optional($impact->innovation)->titre ?? '—' }}</td>
                                <td>{{ $impact->type_impact }}</td>
                                <td>{{ $impact->periode_mesure }}</td>
                                <td>{{ $impact->valeur_avant ?? '—' }}</td>
                                <td>{{ $impact->valeur_apres ?? '—' }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-success-subtle text-success">
                                        {{ $impact->variation ?? '—' }}
                                    </span>
                                </td>
                                <td>{{ $impact->mesures_count }}</td>
                                <td>{{ $impact->beneficiaires_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.impacts.show', $impact) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                    <a href="{{ route('back.innovations.impacts.edit', $impact) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">Aucun impact enregistré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $impacts->links() }}
            </div>
        </div>
    </div>

</div>

@include('back.innovations.impacts._styles')
@endsection
