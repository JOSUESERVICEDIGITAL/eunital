@extends('back.layouts.principal')

@section('title', 'Maintenances ouvertes')
@section('page_title', 'Chambre développement · Maintenances ouvertes')
@section('page_subtitle', 'Interventions actuellement ouvertes et non encore prises en charge ou clôturées.')

@section('content')
    @include('back.chambre-developpement.maintenances._liste-statut', [
        'maintenances' => $maintenances,
        'titreBloc' => 'Maintenances ouvertes',
        'descriptionBloc' => 'Interventions toujours ouvertes.'
    ])
@endsection
