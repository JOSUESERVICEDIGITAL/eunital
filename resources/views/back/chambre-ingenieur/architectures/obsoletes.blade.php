@extends('back.layouts.principal')
@section('title', 'Architectures obsolètes')
@section('page_title', 'Chambre d’ingénieurs · Architectures obsolètes')
@section('page_subtitle', 'Architectures sorties du référentiel actif.')
@section('content')
    @include('back.chambre-ingenieur.architectures._liste-statut', [
        'architectures' => $architectures,
        'titreBloc' => 'Architectures obsolètes',
        'descriptionBloc' => 'Architectures dépassées ou remplacées.'
    ])
@endsection