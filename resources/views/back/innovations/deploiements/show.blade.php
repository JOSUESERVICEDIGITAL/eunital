@extends('back.layouts.principal')

@section('title','Fiche déploiement')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="deploy-hero">
            <div>
                <h2>{{ $deploiement->titre }}</h2>
                <p>{{ $deploiement->description }}</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('back.innovations.deploiements.carte',$deploiement) }}" class="btn btn-light rounded-pill">Carte</a>
            </div>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Couverture</span><strong>{{ $deploiement->couvertures->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Adoption</span><strong>{{ $deploiement->adoptions->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Incidents</span><strong>{{ $deploiement->incidents->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Statut</span><strong>{{ $deploiement->statut }}</strong></div></div>

</div>

@include('back.innovations.deploiements._styles')
@endsection
