@extends('back.layouts.principal')

@section('title','Fiche proposition')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="innovation-show-hero">
            <div>
                <h2>{{ $proposition->titre }}</h2>
                <p>{{ $proposition->description }}</p>
            </div>
            <a href="{{ route('back.innovations.propositions.analyse',$proposition) }}" class="btn btn-light rounded-pill">
                Analyse
            </a>
        </div>
    </div>

    <div class="col-md-3"><div class="mini-stat-card"><span>Votes</span><strong>{{ $proposition->votes->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Commentaires</span><strong>{{ $proposition->commentaires->count() }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Statut</span><strong>{{ $proposition->statut }}</strong></div></div>
    <div class="col-md-3"><div class="mini-stat-card"><span>Priorité</span><strong>{{ $proposition->niveau_priorite }}</strong></div></div>

</div>

@include('back.innovations.propositions._styles')
@endsection
