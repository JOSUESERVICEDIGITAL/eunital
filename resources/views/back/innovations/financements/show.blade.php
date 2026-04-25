@extends('back.layouts.principal')

@section('title', 'Fiche financement')
@section('page_title', 'Fiche financement')
@section('page_subtitle', $financement->source_financement)

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="finance-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">
                    {{ str_replace('_', ' ', $financement->statut) }}
                </span>
                <h2>{{ $financement->source_financement }}</h2>
                <p>
                    Financement lié à :
                    <strong>{{ optional($financement->innovation)->titre ?? 'aucune innovation spécifique' }}</strong>
                </p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.financements.edit', $financement) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                <a href="{{ route('back.innovations.financements.index') }}" class="btn btn-outline-light rounded-pill px-4">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Montant prévu</span>
            <strong>{{ number_format($financement->montant_prevu ?? 0, 0, ',', ' ') }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Montant obtenu</span>
            <strong>{{ number_format($financement->montant_obtenu ?? 0, 0, ',', ' ') }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Écart</span>
            <strong>{{ number_format(($financement->montant_prevu ?? 0) - ($financement->montant_obtenu ?? 0), 0, ',', ' ') }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Taux obtenu</span>
            <strong>
                @if(($financement->montant_prevu ?? 0) > 0)
                    {{ round((($financement->montant_obtenu ?? 0) / $financement->montant_prevu) * 100, 2) }}%
                @else
                    0%
                @endif
            </strong>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <h5 class="fw-bold mb-4">Informations</h5>
            <div class="info-line"><span>Innovation</span><strong>{{ optional($financement->innovation)->titre ?? '—' }}</strong></div>
            <div class="info-line"><span>Type</span><strong>{{ $financement->type_financement ?? '—' }}</strong></div>
            <div class="info-line"><span>Statut</span><strong>{{ str_replace('_', ' ', $financement->statut) }}</strong></div>
            <div class="info-line"><span>Date approbation</span><strong>{{ optional($financement->date_approbation)->format('d/m/Y') ?? '—' }}</strong></div>
        </div>
    </div>

</div>

@include('back.innovations.financements._styles')
@endsection
