@extends('back.layouts.principal')
@section('title', 'Réflexions ouvertes')
@section('page_title', 'Chambre d’ingénieurs · Réflexions ouvertes')
@section('page_subtitle', 'Réflexions actuellement ouvertes.')
@section('content')
    @include('back.chambre-ingenieur.reflexions._liste-statut', [
        'reflexions' => $reflexions,
        'titreBloc' => 'Réflexions ouvertes',
        'descriptionBloc' => 'Réflexions encore en phase active.'
    ])
@endsection