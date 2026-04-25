@extends('back.layouts.principal')

@section('title', 'Déploiements')
@section('page_title', 'Déploiements')
@section('page_subtitle', 'Passage à l’échelle des innovations sur le territoire.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Déploiements</h4>
                <p class="text-muted mb-0">Suivi de la diffusion des innovations à grande échelle.</p>
            </div>

            <a href="{{ route('back.innovations.deploiements.create') }}" class="btn btn-warning rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i>Nouveau déploiement
            </a>
        </div>
    </div>

    @foreach($stats as $label => $value)
        <div class="col-md-2">
            <div class="mini-stat-card">
                <span>{{ ucfirst(str_replace('_',' ',$label)) }}</span>
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
                            <th>Déploiement</th>
                            <th>Innovation</th>
                            <th>Statut</th>
                            <th>Couverture</th>
                            <th>Adoption</th>
                            <th>Incidents</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deploiements as $d)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $d->titre }}</div>
                                    <small class="text-muted">{{ $d->code }}</small>
                                </td>
                                <td>{{ optional($d->innovation)->titre ?? '—' }}</td>
                                <td><span class="badge bg-info-subtle text-info">{{ $d->statut }}</span></td>
                                <td>{{ $d->couvertures_count }}</td>
                                <td>{{ $d->adoptions_count }}</td>
                                <td>{{ $d->incidents_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.deploiements.show',$d) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                    <a href="{{ route('back.innovations.deploiements.edit',$d) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted py-5">Aucun déploiement.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $deploiements->links() }}
        </div>
    </div>

</div>

@include('back.innovations.deploiements._styles')
@endsection
