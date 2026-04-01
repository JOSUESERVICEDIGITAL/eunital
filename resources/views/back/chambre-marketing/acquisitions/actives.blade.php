@extends('back.layouts.principal')

@section('title', 'Acquisitions actives')
@section('page_title', 'Chambre marketing · Acquisitions actives')
@section('page_subtitle', 'Canaux d’acquisition actuellement actifs et suivis.')

@section('content')
    @include('back.chambre-marketing.acquisitions._table', [
        'acquisitions' => $acquisitions,
        'titreBloc' => 'Acquisitions actives',
        'descriptionBloc' => 'Canaux actuellement exploités.'
    ])
@endsection