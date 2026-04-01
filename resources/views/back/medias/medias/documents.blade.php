@extends('back.layouts.principal')
@section('title', 'Documents')
@section('page_title', 'Documents')
@section('page_subtitle', 'Vue filtrée des documents de la bibliothèque.')
@section('content')
    @include('back.medias.medias._liste-type', [
        'medias' => $medias,
        'titreBloc' => 'Documents',
        'descriptionBloc' => 'Tous les documents du hub.'
    ])
@endsection