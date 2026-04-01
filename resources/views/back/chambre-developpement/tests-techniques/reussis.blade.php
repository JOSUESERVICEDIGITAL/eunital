@extends('back.layouts.principal')

@section('title', 'Tests réussis')
@section('page_title', 'Chambre développement · Tests réussis')
@section('page_subtitle', 'Tests ayant abouti à un résultat positif.')

@section('content')
    @include('back.chambre-developpement.tests-techniques._liste-statut', [
        'tests' => $tests,
        'titreBloc' => 'Tests réussis',
        'descriptionBloc' => 'Tests validés avec succès.'
    ])
@endsection
