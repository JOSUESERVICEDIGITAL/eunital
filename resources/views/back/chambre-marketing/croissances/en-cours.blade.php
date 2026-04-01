@extends('back.layouts.principal')

@section('title', 'Croissances en cours')
@section('page_title', 'Chambre marketing · Croissances en cours')
@section('page_subtitle', 'Actions de croissance actuellement déployées ou en exécution.')

@section('content')
    @include('back.chambre-marketing.croissances._table', [
        'croissances' => $croissances,
        'titreBloc' => 'Actions en cours',
        'descriptionBloc' => 'Actions actuellement en exécution.'
    ])
@endsection