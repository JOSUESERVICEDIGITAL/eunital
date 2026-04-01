@extends('back.layouts.principal')
@section('title', 'Études favorables')
@section('page_title', 'Chambre d’ingénieurs · Études favorables')
@section('page_subtitle', 'Études concluant à une faisabilité favorable.')
@section('content')
    @include('back.chambre-ingenieur.etudes._liste-statut', [
        'etudes' => $etudes,
        'titreBloc' => 'Études favorables',
        'descriptionBloc' => 'Études validées positivement.'
    ])
@endsection