@extends('back.layouts.principal')

@section('title', 'Images de marque obsolètes')
@section('page_title', 'Chambre marketing · Images de marque obsolètes')
@section('page_subtitle', 'Anciennes identités, chartes ou styles devenus obsolètes.')

@section('content')
    @include('back.chambre-marketing.images-marque._table', [
        'imagesMarque' => $imagesMarque,
        'titreBloc' => 'Images de marque obsolètes',
        'descriptionBloc' => 'Identités visuelles qui ne sont plus à jour.'
    ])
@endsection