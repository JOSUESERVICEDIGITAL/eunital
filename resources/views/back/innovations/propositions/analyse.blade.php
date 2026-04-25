@extends('back.layouts.principal')

@section('title','Analyse proposition')

@section('content')
<div class="content-card">

    <h4 class="fw-bold mb-4">Analyse</h4>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="mini-stat-card">
                <span>Votes pour</span>
                <strong>{{ $analyse['votes_pour'] }}</strong>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mini-stat-card">
                <span>Votes contre</span>
                <strong>{{ $analyse['votes_contre'] }}</strong>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mini-stat-card">
                <span>Commentaires</span>
                <strong>{{ $analyse['commentaires'] }}</strong>
            </div>
        </div>
    </div>

</div>

@include('back.innovations.propositions._styles')
@endsection
