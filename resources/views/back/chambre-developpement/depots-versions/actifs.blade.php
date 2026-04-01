@extends('back.layouts.principal')

@section('title', 'Dépôts actifs')
@section('page_title', 'Chambre développement · Dépôts actifs')
@section('page_subtitle', 'Dépôts et versions actuellement actifs dans le cycle de développement.')

@section('content')
    @include('back.chambre-developpement.depots-versions._liste-statut', [
        'depots' => $depots,
        'titreBloc' => 'Dépôts actifs',
        'descriptionBloc' => 'Dépôts actuellement actifs.'
    ])
@endsection
