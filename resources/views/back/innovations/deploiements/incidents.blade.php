@extends('back.layouts.principal')

@section('title','Incidents')

@section('content')
<div class="content-card">
    <h4>Incidents</h4>

    @foreach($deploiement->incidents as $i)
        <div class="risk-card">
            <h6>{{ $i->titre }}</h6>
            <p>{{ $i->description }}</p>
        </div>
    @endforeach
</div>

@include('back.innovations.deploiements._styles')
@endsection
