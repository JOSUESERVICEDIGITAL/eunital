@extends('back.layouts.principal')
@section('title', 'Messages envoyés')
@section('page_title', 'Messages envoyés')
@section('page_subtitle', 'Vue filtrée des messages envoyés.')
@section('content')
    @include('back.equipe.messages._liste-statut', [
        'messages' => $messages,
        'titreBloc' => 'Messages envoyés',
        'descriptionBloc' => 'Messages envoyés depuis les membres du hub.',
    ])
@endsection