@extends('back.layouts.principal')

@section('title', 'Maturité idées')
@section('page_title', 'Maturité des idées')
@section('page_subtitle', 'Répartition des idées selon leur niveau de maturité.')

@section('content')
<div class="row g-4">
    @foreach($stats as $niveau => $total)
        <div class="col-md-3">
            <div class="mini-stat-card">
                <span>{{ ucfirst($niveau) }}</span>
                <strong>{{ $total }}</strong>
            </div>
        </div>
    @endforeach
</div>

@include('back.innovations.idees._styles')
@endsection
