@extends('back.layouts.principal')

@section('title','Couverture')

@section('content')
<div class="content-card">
    <h4>Zones couvertes</h4>

    @foreach($deploiement->couvertures as $c)
        <div class="info-line">
            <span>{{ $c->zone }}</span>
            <strong>{{ $c->taux_couverture }}%</strong>
        </div>
    @endforeach
</div>

@include('back.innovations.deploiements._styles')
@endsection
