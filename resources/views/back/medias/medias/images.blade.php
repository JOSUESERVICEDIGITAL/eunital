@extends('back.layouts.principal')
@section('title', 'Images')
@section('page_title', 'Images')
@section('page_subtitle', 'Vue filtrée des images de la bibliothèque.')
@section('content')
    @include('back.medias.medias._liste-type', [
        'medias' => $medias,
        'titreBloc' => 'Images',
        'descriptionBloc' => 'Toutes les images du hub.'
    ])
@endsection