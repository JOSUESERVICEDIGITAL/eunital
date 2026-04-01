@extends('back.layouts.principal')
@section('title', 'Idées retenues')
@section('page_title', 'Chambre d’ingénieurs · Idées retenues')
@section('page_subtitle', 'Idées retenues pour exécution ou approfondissement.')
@section('content')
    @include('back.chambre-ingenieur.idees._liste-statut', [
        'idees' => $idees,
        'titreBloc' => 'Idées retenues',
        'descriptionBloc' => 'Idées validées pour suite opérationnelle.'
    ])
@endsection