@extends('back.layouts.principal')
@section('title', 'Dossiers brouillons')
@section('page_title', 'Chambre d’ingénieurs · Dossiers brouillons')
@section('page_subtitle', 'Dossiers en cours de préparation.')
@section('content')
    @include('back.chambre-ingenieur.dossiers._liste-statut', [
        'dossiers' => $dossiers,
        'titreBloc' => 'Dossiers brouillons',
        'descriptionBloc' => 'Dossiers non encore publiés.'
    ])
@endsection