@extends('back.layouts.principal')

@section('title', 'Versions hotfix')
@section('page_title', 'Chambre développement · Versions hotfix')
@section('page_subtitle', 'Correctifs urgents et versions de type hotfix.')

@section('content')
    @include('back.chambre-developpement.depots-versions._liste-statut', [
        'depots' => $depots,
        'titreBloc' => 'Versions hotfix',
        'descriptionBloc' => 'Correctifs urgents du hub.'
    ])
@endsection
