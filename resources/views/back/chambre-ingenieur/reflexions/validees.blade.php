@extends('back.layouts.principal')
@section('title', 'Réflexions validées')
@section('page_title', 'Chambre d’ingénieurs · Réflexions validées')
@section('page_subtitle', 'Réflexions validées dans la chambre.')
@section('content')
    @include('back.chambre-ingenieur.reflexions._liste-statut', [
        'reflexions' => $reflexions,
        'titreBloc' => 'Réflexions validées',
        'descriptionBloc' => 'Réflexions ayant reçu une validation.'
    ])
@endsection