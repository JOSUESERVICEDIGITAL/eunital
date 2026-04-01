@extends('back.layouts.principal')

@section('title', 'Maintenances critiques')
@section('page_title', 'Chambre développement · Maintenances critiques')
@section('page_subtitle', 'Interventions de niveau critique nécessitant une attention immédiate.')

@section('content')
    @include('back.chambre-developpement.maintenances._liste-statut', [
        'maintenances' => $maintenances,
        'titreBloc' => 'Maintenances critiques',
        'descriptionBloc' => 'Interventions à urgence critique.'
    ])
@endsection
