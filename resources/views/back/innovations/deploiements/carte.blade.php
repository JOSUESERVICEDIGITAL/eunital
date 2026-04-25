@extends('back.layouts.principal')

@section('title','Carte déploiement')

@section('content')
<div class="content-card">
    <h4>Carte de déploiement</h4>

    <div class="map-placeholder">
        Carte interactive ici (Leaflet / Mapbox plus tard)
    </div>
</div>

@include('back.innovations.deploiements._styles')
@endsection
