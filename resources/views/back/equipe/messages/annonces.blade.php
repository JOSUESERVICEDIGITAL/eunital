@extends('back.layouts.principal')
@section('title', 'Annonces internes')
@section('page_title', 'Annonces internes')
@section('page_subtitle', 'Vue filtrée des annonces diffusées dans l’organisation.')
@section('content')
    @include('back.equipe.messages._liste-statut', [
        'messages' => $messages,
        'titreBloc' => 'Annonces internes',
        'descriptionBloc' => 'Messages de type annonce.',
    ])
@endsection