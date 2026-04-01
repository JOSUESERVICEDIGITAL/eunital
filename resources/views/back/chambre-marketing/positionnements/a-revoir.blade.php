@extends('back.layouts.principal')

@section('title', 'Positionnements à revoir')
@section('page_title', 'Chambre marketing · Positionnements à revoir')
@section('page_subtitle', 'Axes stratégiques qui nécessitent une révision ou un ajustement.')

@section('content')
    @include('back.chambre-marketing.positionnements._table', [
        'positionnements' => $positionnements,
        'titreBloc' => 'Positionnements à revoir',
        'descriptionBloc' => 'Positionnements nécessitant des corrections.'
    ])
@endsection