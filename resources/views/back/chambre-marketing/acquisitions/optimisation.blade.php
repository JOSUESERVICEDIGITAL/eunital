@extends('back.layouts.principal')

@section('title', 'Acquisitions en optimisation')
@section('page_title', 'Chambre marketing · Acquisitions en optimisation')
@section('page_subtitle', 'Canaux d’acquisition en cours d’amélioration ou de réglage.')

@section('content')
    @include('back.chambre-marketing.acquisitions._table', [
        'acquisitions' => $acquisitions,
        'titreBloc' => 'Acquisitions en optimisation',
        'descriptionBloc' => 'Canaux nécessitant ajustements et amélioration.'
    ])
@endsection