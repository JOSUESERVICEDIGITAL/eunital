@extends('back.layouts.principal')
@section('title', 'Études réservées')
@section('page_title', 'Chambre d’ingénieurs · Études réservées')
@section('page_subtitle', 'Études avec réserves ou conditions.')
@section('content')
    @include('back.chambre-ingenieur.etudes._liste-statut', [
        'etudes' => $etudes,
        'titreBloc' => 'Études réservées',
        'descriptionBloc' => 'Études nécessitant prudence ou ajustements.'
    ])
@endsection