@extends('back.layouts.principal')

@section('title', 'Synthèse réforme')
@section('page_title', 'Synthèse réforme')
@section('page_subtitle', $reforme->titre)

@section('content')
<div class="row g-4">

    @foreach($stats as $label => $value)
        <div class="col-md-3">
            <div class="mini-stat-card">
                <span>{{ ucfirst(str_replace('_', ' ', $label)) }}</span>
                <strong>{{ $value }}</strong>
            </div>
        </div>
    @endforeach

    <div class="col-12">
        <div class="content-card">
            <h4 class="fw-bold">Objectif</h4>
            <p class="text-muted mb-0">{{ $reforme->objectif ?? 'Aucun objectif renseigné.' }}</p>
        </div>
    </div>

</div>

@include('back.innovations.reformes._styles')
@endsection
