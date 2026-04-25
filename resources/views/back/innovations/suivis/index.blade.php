@extends('back.layouts.principal')

@section('title', 'Suivis innovation')
@section('page_title', 'Suivis innovation')
@section('page_subtitle', 'Monitoring régulier des innovations, progression, risques et recommandations.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Suivis</h4>
                <p class="text-muted mb-0">Tableau de suivi opérationnel des innovations.</p>
            </div>

            <a href="{{ route('back.innovations.suivis.create') }}" class="btn btn-warning rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i>Nouveau suivi
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
                            <th>Date suivi</th>
                            <th>Statut global</th>
                            <th>Progression</th>
                            <th>Étapes</th>
                            <th>Blocages</th>
                            <th>Notifications</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suivis as $suivi)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ optional($suivi->innovation)->titre ?? '—' }}</div>
                                    <small class="text-muted">{{ Str::limit($suivi->resume, 60) }}</small>
                                </td>
                                <td>{{ optional($suivi->date_suivi)->format('d/m/Y') ?? '—' }}</td>
                                <td><span class="badge bg-info-subtle text-info">{{ $suivi->statut_global }}</span></td>
                                <td>
                                    <div class="progress rounded-pill" style="height: 10px;">
                                        <div class="progress-bar bg-warning" style="width: {{ $suivi->progression ?? 0 }}%"></div>
                                    </div>
                                    <small>{{ $suivi->progression ?? 0 }}%</small>
                                </td>
                                <td>{{ $suivi->etapes_count }}</td>
                                <td>{{ $suivi->blocages_count }}</td>
                                <td>{{ $suivi->notifications_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.suivis.show', $suivi) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                    <a href="{{ route('back.innovations.suivis.timeline', $suivi) }}" class="btn btn-sm btn-outline-primary rounded-pill">Timeline</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted py-5">Aucun suivi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $suivis->links() }}
        </div>
    </div>

</div>

@include('back.innovations.suivis._styles')
@endsection
