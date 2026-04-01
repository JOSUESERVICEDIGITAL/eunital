@extends('back.layouts.principal')
@section('title', 'Prototypes en cours')
@section('page_title', 'Chambre d’ingénieurs · Prototypes en cours')
@section('page_subtitle', 'Prototypes actuellement actifs.')
@section('content')
    @include('back.chambre-ingenieur.prototypes._liste-statut', [
        'prototypes' => $prototypes,
        'titreBloc' => 'Prototypes en cours',
        'descriptionBloc' => 'Prototypes actuellement en développement ou test.'
    ])
@endsection