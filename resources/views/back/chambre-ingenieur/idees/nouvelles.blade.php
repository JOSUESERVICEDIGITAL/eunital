@extends('back.layouts.principal')
@section('title', 'Idées nouvelles')
@section('page_title', 'Chambre d’ingénieurs · Idées nouvelles')
@section('page_subtitle', 'Nouvelles idées déposées dans la chambre.')
@section('content')
    @include('back.chambre-ingenieur.idees._liste-statut', [
        'idees' => $idees,
        'titreBloc' => 'Idées nouvelles',
        'descriptionBloc' => 'Idées nouvellement enregistrées, en attente de première analyse.'
    ])
@endsection