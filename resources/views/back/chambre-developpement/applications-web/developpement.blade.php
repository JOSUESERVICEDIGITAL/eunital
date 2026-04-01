@extends('back.layouts.principal')
@section('title', 'Applications web en développement')
@section('page_title', 'Chambre développement · Applications web en développement')
@section('page_subtitle', 'Applications en cours de production.')
@section('content')
    @include('back.chambre-developpement.applications-web._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications en développement',
        'descriptionBloc' => 'Applications actuellement en construction.'
    ])
@endsection
