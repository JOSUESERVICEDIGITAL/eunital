@extends('back.layouts.principal')

@section('title', 'Tests planifiés')
@section('page_title', 'Chambre développement · Tests planifiés')
@section('page_subtitle', 'Tests prévus mais non encore démarrés.')

@section('content')
    @include('back.chambre-developpement.tests-techniques._liste-statut', [
        'tests' => $tests,
        'titreBloc' => 'Tests planifiés',
        'descriptionBloc' => 'Tests encore en attente d’exécution.'
    ])
@endsection
