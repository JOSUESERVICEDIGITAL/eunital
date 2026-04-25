@extends('back.layouts.principal')

@section('title', 'Statistiques financements')
@section('page_title', 'Statistiques financières')
@section('page_subtitle', 'Vue globale des montants prévus, obtenus et restants.')

@section('content')
<div class="row g-4">

    <div class="col-md-6">
        <div class="mini-stat-card finance-big">
            <span>Total prévu</span>
            <strong>{{ number_format($stats['total_prevu'] ?? 0, 0, ',', ' ') }}</strong>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mini-stat-card finance-big">
            <span>Total obtenu</span>
            <strong>{{ number_format($stats['total_obtenu'] ?? 0, 0, ',', ' ') }}</strong>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            @php
                $prevu = $stats['total_prevu'] ?? 0;
                $obtenu = $stats['total_obtenu'] ?? 0;
                $taux = $prevu > 0 ? round(($obtenu / $prevu) * 100, 2) : 0;
            @endphp

            <div class="section-head">
                <div>
                    <h4>Taux de mobilisation</h4>
                    <p>Part du financement obtenu par rapport au prévisionnel.</p>
                </div>
                <strong class="fs-3">{{ $taux }}%</strong>
            </div>

            <div class="finance-bar">
                <div class="finance-progress" style="width: {{ min($taux, 100) }}%"></div>
            </div>
        </div>
    </div>

</div>

@include('back.innovations.financements._styles')
@endsection
