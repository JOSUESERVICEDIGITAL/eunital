@extends('back.layouts.principal')

@section('title', 'Maintenances résolues')
@section('page_title', 'Chambre développement · Maintenances résolues')
@section('page_subtitle', 'Interventions déjà corrigées ou marquées comme résolues.')

@section('content')
    @include('back.chambre-developpement.maintenances._liste-statut', [
        'maintenances' => $maintenances,
        'titreBloc' => 'Maintenances résolues',
        'descriptionBloc' => 'Interventions terminées avec succès.'
    ])
@endsection
