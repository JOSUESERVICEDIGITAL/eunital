@extends('back.layouts.principal')

@section('title', 'Positionnements actifs')
@section('page_title', 'Chambre marketing · Positionnements actifs')
@section('page_subtitle', 'Axes de positionnement validés et actuellement utilisés.')

@section('content')
    @include('back.chambre-marketing.positionnements._table', [
        'positionnements' => $positionnements,
        'titreBloc' => 'Positionnements actifs',
        'descriptionBloc' => 'Positionnements actuellement retenus.'
    ])
@endsection