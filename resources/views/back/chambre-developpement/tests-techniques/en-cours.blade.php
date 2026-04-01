@extends('back.layouts.principal')

@section('title', 'Tests en cours')
@section('page_title', 'Chambre développement · Tests en cours')
@section('page_subtitle', 'Tests actuellement exécutés ou en observation.')

@section('content')
    @include('back.chambre-developpement.tests-techniques._liste-statut', [
        'tests' => $tests,
        'titreBloc' => 'Tests en cours',
        'descriptionBloc' => 'Tests actuellement lancés.'
    ])
@endsection
