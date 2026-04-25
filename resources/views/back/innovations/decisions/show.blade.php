@extends('back.layouts.principal')

@section('title','Fiche décision')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="decision-hero">
            <div>
                <span class="badge bg-warning-subtle text-warning mb-2">{{ $decision->statut }}</span>
                <h2>{{ $decision->titre }}</h2>
                <p>{{ $decision->decision }}</p>
            </div>

            <div>
                <a href="{{ route('back.innovations.decisions.edit',$decision) }}" class="btn btn-warning">Modifier</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Date</span>
            <strong>{{ optional($decision->date_decision)->format('d/m/Y') }}</strong>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card">
            <span>Auteur</span>
            <strong>{{ optional($decision->auteur)->name }}</strong>
        </div>
    </div>

    <div class="col-md-6">
        <div class="content-card">
            <h5>Réforme liée</h5>
            <p>{{ optional($decision->reforme)->titre ?? '—' }}</p>
        </div>
    </div>

</div>

@include('back.innovations.decisions._styles')
@endsection
