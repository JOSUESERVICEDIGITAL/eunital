@extends('back.layouts.principal')

@section('title', 'Budget portefeuille')
@section('page_title', 'Budget portefeuille')
@section('page_subtitle', $portefeuille->nom)

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card">
            <div class="section-head">
                <div>
                    <h4>Suivi budgétaire</h4>
                    <p>Prévisionnel, consommé et reste disponible.</p>
                </div>
                <a href="{{ route('back.innovations.portefeuilles.show', $portefeuille) }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Retour
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card"><span>Prévisionnel</span><strong>{{ number_format($budget['previsionnel'] ?? 0, 0, ',', ' ') }}</strong></div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card"><span>Consommé</span><strong>{{ number_format($budget['consomme'] ?? 0, 0, ',', ' ') }}</strong></div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card"><span>Reste</span><strong>{{ number_format($budget['reste'] ?? 0, 0, ',', ' ') }}</strong></div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card"><span>Taux</span><strong>{{ $budget['taux'] ?? 0 }}%</strong></div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <div class="budget-bar">
                <div class="budget-progress" style="width: {{ min($budget['taux'] ?? 0, 100) }}%"></div>
            </div>
            <p class="text-muted mt-3 mb-0">
                Taux de consommation budgétaire du portefeuille.
            </p>
        </div>
    </div>

</div>

@include('back.innovations.portefeuilles._styles')
@endsection
