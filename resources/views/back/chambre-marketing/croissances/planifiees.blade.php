@extends('back.layouts.principal')

@section('title', 'Croissances planifiées')
@section('page_title', 'Chambre marketing · Croissances planifiées')
@section('page_subtitle', 'Actions de croissance prévues mais non encore lancées.')

@section('content')
    @include('back.chambre-marketing.croissances._table', [
        'croissances' => $croissances,
        'titreBloc' => 'Actions planifiées',
        'descriptionBloc' => 'Actions prévues dans la stratégie de croissance.'
    ])
@endsection