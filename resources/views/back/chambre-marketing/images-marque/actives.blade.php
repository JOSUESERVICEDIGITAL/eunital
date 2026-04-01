@extends('back.layouts.principal')

@section('title', 'Images de marque actives')
@section('page_title', 'Chambre marketing · Images de marque actives')
@section('page_subtitle', 'Identités de marque actuellement utilisées et validées.')

@section('content')
    @include('back.chambre-marketing.images-marque._table', [
        'imagesMarque' => $imagesMarque,
        'titreBloc' => 'Images de marque actives',
        'descriptionBloc' => 'Identités visuelles actuellement en usage.'
    ])
@endsection