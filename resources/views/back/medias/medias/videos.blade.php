@extends('back.layouts.principal')
@section('title', 'Vidéos')
@section('page_title', 'Vidéos')
@section('page_subtitle', 'Vue filtrée des vidéos de la bibliothèque.')
@section('content')
    @include('back.medias.medias._liste-type', [
        'medias' => $medias,
        'titreBloc' => 'Vidéos',
        'descriptionBloc' => 'Toutes les vidéos du hub.'
    ])
@endsection