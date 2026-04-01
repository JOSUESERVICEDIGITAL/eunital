@extends('back.layouts.principal')

@section('title', 'Tests échoués')
@section('page_title', 'Chambre développement · Tests échoués')
@section('page_subtitle', 'Tests ayant révélé des anomalies ou des écarts.')

@section('content')
    @include('back.chambre-developpement.tests-techniques._liste-statut', [
        'tests' => $tests,
        'titreBloc' => 'Tests échoués',
        'descriptionBloc' => 'Tests ayant retourné un résultat négatif.'
    ])
@endsection
