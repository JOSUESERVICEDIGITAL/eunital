@extends('back.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="mb-1">🎉 Événements studio</h4>
            <small class="text-muted">Gestion des mariages, concerts, conférences et autres événements clients</small>
        </div>

        <a href="{{ route('back.chambre-studio.evenements.creer') }}" class="btn btn-dark">
            + Nouvel événement
        </a>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('back.chambre-studio.evenements.tous') }}" class="btn btn-outline-dark">Tous</a>
        <a href="{{ route('back.chambre-studio.evenements.planifies') }}" class="btn btn-outline-primary">Planifiés</a>
        <a href="{{ route('back.chambre-studio.evenements.realises') }}" class="btn btn-outline-success">Réalisés</a>
        <a href="{{ route('back.chambre-studio.evenements.annules') }}" class="btn btn-outline-danger">Annulés</a>
        <a href="{{ route('back.chambre-studio.evenements.mariages') }}" class="btn btn-outline-warning">Mariages</a>
    </div>

    @include('back.chambre-studio.evenements._liste-table', ['evenements' => $evenements])

</div>
@endsection