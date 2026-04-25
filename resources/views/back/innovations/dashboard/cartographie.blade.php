@extends('back.layouts.principal')

@section('title', 'Cartographie innovation')
@section('page_title', 'Cartographie des innovations')
@section('page_subtitle', 'Vue territoriale des initiatives rattachées aux régions.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card">
            <div class="section-head">
                <div>
                    <h4>Cartographie territoriale</h4>
                    <p>Innovations rattachées à une zone ou une région.</p>
                </div>
                <a href="{{ route('back.innovations.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Retour dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <div class="map-placeholder">
                <i class="fa-solid fa-map-location-dot"></i>
                <h4>Carte dynamique à connecter</h4>
                <p>
                    Ici tu pourras intégrer plus tard une carte Leaflet, Google Maps,
                    Mapbox ou une carte SVG nationale.
                </p>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Innovations localisées</h5>

            <div class="hub-list">
                @forelse($innovations as $innovation)
                    <a href="{{ route('back.innovations.innovations.show', $innovation) }}" class="hub-list-item">
                        <div class="hub-list-icon warning">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $innovation->titre }}</div>
                            <small>
                                Région ID : {{ $innovation->region_id }}
                                • {{ optional($innovation->portefeuille)->nom ?? 'Sans portefeuille' }}
                            </small>
                        </div>
                    </a>
                @empty
                    <div class="empty-mini">Aucune innovation localisée.</div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@include('back.innovations.dashboard._styles')
@endsection
