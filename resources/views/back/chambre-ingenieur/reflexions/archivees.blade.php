@extends('back.layouts.principal')
@section('title', 'Réflexions archivées')
@section('page_title', 'Chambre d’ingénieurs · Réflexions archivées')
@section('page_subtitle', 'Historique des réflexions archivées.')
@section('content')
    @include('back.chambre-ingenieur.reflexions._liste-statut', [
        'reflexions' => $reflexions,
        'titreBloc' => 'Réflexions archivées',
        'descriptionBloc' => 'Réflexions sorties du circuit actif.'
    ])
@endsection