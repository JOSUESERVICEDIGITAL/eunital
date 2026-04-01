@extends('back.layouts.principal')
@section('title', 'Idées critiques')
@section('page_title', 'Chambre d’ingénieurs · Idées critiques')
@section('page_subtitle', 'Idées à priorité critique.')
@section('content')
    @include('back.chambre-ingenieur.idees._liste-statut', [
        'idees' => $idees,
        'titreBloc' => 'Idées critiques',
        'descriptionBloc' => 'Idées jugées urgentes ou hautement stratégiques.'
    ])
@endsection