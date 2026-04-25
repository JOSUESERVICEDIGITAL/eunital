@extends('back.layouts.principal')

@section('title', 'Financements innovation')
@section('page_title', 'Financements')
@section('page_subtitle', 'Sources, montants prévus, montants obtenus et statuts financiers.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">Financements</h4>
                <p class="text-muted mb-0">Suivi financier des innovations et programmes.</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.financements.stats') }}" class="btn btn-outline-primary rounded-pill px-4">
                    Statistiques
                </a>
                <a href="{{ route('back.innovations.financements.create') }}" class="btn btn-warning rounded-pill px-4">
                    <i class="fa-solid fa-plus me-2"></i>Nouveau financement
                </a>
            </div>
        </div>
    </div>

    @if(isset($stats))
        <div class="col-md-3">
            <div class="mini-stat-card">
                <span>Total prévu</span>
                <strong>{{ number_format($stats['total_prevu'] ?? 0, 0, ',', ' ') }}</strong>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mini-stat-card">
                <span>Total obtenu</span>
                <strong>{{ number_format($stats['total_obtenu'] ?? 0, 0, ',', ' ') }}</strong>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mini-stat-card">
                <span>Approuvés</span>
                <strong>{{ $stats['approuves'] ?? 0 }}</strong>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mini-stat-card">
                <span>En attente</span>
                <strong>{{ $stats['en_attente'] ?? 0 }}</strong>
            </div>
        </div>
    @endif

    <div class="col-12">
        <div class="content-card">
            <div class="table-responsive">
                <table class="table align-middle hub-table">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Innovation</th>
                            <th>Type</th>
                            <th>Prévu</th>
                            <th>Obtenu</th>
                            <th>Statut</th>
                            <th>Date approbation</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($financements as $financement)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $financement->source_financement }}</div>
                                    <small class="text-muted">{{ $financement->type_financement ?? 'Type non défini' }}</small>
                                </td>
                                <td>{{ optional($financement->innovation)->titre ?? '—' }}</td>
                                <td>{{ $financement->type_financement ?? '—' }}</td>
                                <td>{{ number_format($financement->montant_prevu ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ number_format($financement->montant_obtenu ?? 0, 0, ',', ' ') }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-info-subtle text-info">
                                        {{ str_replace('_', ' ', $financement->statut) }}
                                    </span>
                                </td>
                                <td>{{ optional($financement->date_approbation)->format('d/m/Y') ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.financements.show', $financement) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                                    <a href="{{ route('back.innovations.financements.edit', $financement) }}" class="btn btn-sm btn-warning rounded-pill">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">Aucun financement enregistré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $financements->links() }}
            </div>
        </div>
    </div>

</div>

@include('back.innovations.financements._styles')
@endsection
