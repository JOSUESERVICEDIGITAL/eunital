@extends('back.layouts.principal')
@section('title', 'Idées en étude')
@section('page_title', 'Chambre d’ingénieurs · Idées en étude')
@section('page_subtitle', 'Idées actuellement à l’étude.')
@section('content')
    @include('back.chambre-ingenieur.idees._liste-statut', [
        'idees' => $idees,
        'titreBloc' => 'Idées en étude',
        'descriptionBloc' => 'Idées en cours d’analyse ou de qualification.'
    ])
@endsection