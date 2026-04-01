@extends('back.layouts.principal')

@section('title', 'Maintenances en cours')
@section('page_title', 'Chambre développement · Maintenances en cours')
@section('page_subtitle', 'Interventions actuellement prises en charge par les équipes techniques.')

@section('content')
    @include('back.chambre-developpement.maintenances._liste-statut', [
        'maintenances' => $maintenances,
        'titreBloc' => 'Maintenances en cours',
        'descriptionBloc' => 'Interventions actuellement traitées.'
    ])
@endsection
