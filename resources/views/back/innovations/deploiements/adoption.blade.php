@extends('back.layouts.principal')

@section('title','Adoption')

@section('content')
<div class="content-card">
    <h4>Taux d’adoption</h4>

    @foreach($deploiement->adoptions as $a)
        <div class="info-line">
            <span>{{ $a->zone }}</span>
            <strong>{{ $a->taux_adoption }}%</strong>
        </div>
    @endforeach
</div>

@include('back.innovations.deploiements._styles')
@endsection
