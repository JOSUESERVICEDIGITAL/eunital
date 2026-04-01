@extends('back.layouts.principal')

@section('title', 'Sites vitrines en ligne')
@section('page_title', 'Chambre développement · Sites vitrines en ligne')
@section('page_subtitle', 'Sites actuellement publiés et accessibles en production.')

@section('content')
    @include('back.chambre-developpement.sites-vitrines._liste-statut', [
        'sites' => $sites,
        'titreBloc' => 'Sites en ligne',
        'descriptionBloc' => 'Sites actuellement en production.'
    ])
@endsection
