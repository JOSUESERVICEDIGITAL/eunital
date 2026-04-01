@extends('back.layouts.principal')

@section('title', 'Dépôts déployés')
@section('page_title', 'Chambre développement · Dépôts déployés')
@section('page_subtitle', 'Versions déjà livrées ou déployées en environnement cible.')

@section('content')
    @include('back.chambre-developpement.depots-versions._liste-statut', [
        'depots' => $depots,
        'titreBloc' => 'Dépôts déployés',
        'descriptionBloc' => 'Versions et dépôts déjà déployés.'
    ])
@endsection
