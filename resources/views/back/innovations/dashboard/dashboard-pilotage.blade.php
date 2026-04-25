@extends('back.layouts.principal')

@section('title', 'Pilotage innovation')
@section('page_title', 'Pilotage stratégique')
@section('page_subtitle', 'Répartition des innovations par statut, type et priorité.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card">
            <div class="section-head">
                <div>
                    <h4>Pilotage stratégique</h4>
                    <p>Vue synthétique pour la gouvernance de la chambre.</p>
                </div>
                <a href="{{ route('back.innovations.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Retour dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Par statut</h5>
            @foreach($parStatut as $statut => $total)
                <div class="ranking-line">
                    <span>{{ ucfirst(str_replace('_', ' ', $statut)) }}</span>
                    <strong>{{ $total }}</strong>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Par type</h5>
            @foreach($parType as $type => $total)
                <div class="ranking-line">
                    <span>{{ ucfirst($type) }}</span>
                    <strong>{{ $total }}</strong>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Par priorité</h5>
            @foreach($parPriorite as $priorite => $total)
                <div class="ranking-line">
                    <span>{{ ucfirst($priorite) }}</span>
                    <strong>{{ $total }}</strong>
                </div>
            @endforeach
        </div>
    </div>

</div>

@include('back.innovations.dashboard._styles')
@endsection
