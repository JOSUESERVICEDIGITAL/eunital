@extends('back.layouts.principal')

@section('title', 'Synthèse innovation')
@section('page_title', 'Synthèse')
@section('page_subtitle', $innovation->titre)

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="content-card">
            <div class="section-head">
                <div>
                    <h4>Synthèse globale</h4>
                    <p>Résumé stratégique de l’innovation.</p>
                </div>
                <a href="{{ route('back.innovations.innovations.show', $innovation) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
            </div>

            <div class="row g-3">
                <div class="col-md-3"><div class="mini-stat-card"><span>Objectifs</span><strong>{{ $innovation->objectifs->count() }}</strong></div></div>
                <div class="col-md-3"><div class="mini-stat-card"><span>Indicateurs</span><strong>{{ $innovation->indicateurs->count() }}</strong></div></div>
                <div class="col-md-3"><div class="mini-stat-card"><span>Déploiements</span><strong>{{ $innovation->deploiements->count() }}</strong></div></div>
                <div class="col-md-3"><div class="mini-stat-card"><span>Impacts</span><strong>{{ $innovation->impacts->count() }}</strong></div></div>
            </div>
        </div>
    </div>
</div>

@include('back.innovations.innovations._styles')
@endsection
