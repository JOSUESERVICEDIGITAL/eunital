@extends('back.layouts.principal')

@section('title', 'Performance innovation')
@section('page_title', 'Performance')
@section('page_subtitle', $innovation->titre)

@section('content')
<div class="row g-4">
    @foreach($stats as $label => $value)
        <div class="col-md-4">
            <div class="mini-stat-card">
                <span>{{ ucfirst(str_replace('_', ' ', $label)) }}</span>
                <strong>{{ $value ?? 0 }}</strong>
            </div>
        </div>
    @endforeach
</div>

@include('back.innovations.innovations._styles')
@endsection
