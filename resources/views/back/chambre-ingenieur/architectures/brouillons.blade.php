@extends('back.layouts.principal')
@section('title', 'Architectures brouillons')
@section('page_title', 'Chambre d’ingénieurs · Architectures brouillons')
@section('page_subtitle', 'Architectures encore en conception.')
@section('content')
    @include('back.chambre-ingenieur.architectures._liste-statut', [
        'architectures' => $architectures,
        'titreBloc' => 'Architectures brouillons',
        'descriptionBloc' => 'Architectures encore en cours de formalisation.'
    ])
@endsection