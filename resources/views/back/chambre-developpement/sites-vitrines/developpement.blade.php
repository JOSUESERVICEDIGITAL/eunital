@extends('back.layouts.principal')

@section('title', 'Sites vitrines en développement')
@section('page_title', 'Chambre développement · Sites vitrines en développement')
@section('page_subtitle', 'Sites actuellement en cours de production technique.')

@section('content')
    @include('back.chambre-developpement.sites-vitrines._liste-statut', [
        'sites' => $sites,
        'titreBloc' => 'Sites en développement',
        'descriptionBloc' => 'Sites actuellement en construction.'
    ])
@endsection
