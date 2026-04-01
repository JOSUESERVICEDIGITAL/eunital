@extends('back.layouts.principal')
@section('title', 'Messages reçus')
@section('page_title', 'Messages reçus')
@section('page_subtitle', 'Vue filtrée des messages reçus.')
@section('content')
    @include('back.equipe.messages._liste-statut', [
        'messages' => $messages,
        'titreBloc' => 'Messages reçus',
        'descriptionBloc' => 'Messages adressés aux membres.',
    ])
@endsection