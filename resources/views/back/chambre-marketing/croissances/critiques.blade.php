@extends('back.layouts.principal')

@section('title', 'Croissances critiques')
@section('page_title', 'Chambre marketing · Croissances critiques')
@section('page_subtitle', 'Actions de croissance jugées critiques ou hautement prioritaires.')

@section('content')
    @include('back.chambre-marketing.croissances._table', [
        'croissances' => $croissances,
        'titreBloc' => 'Actions critiques',
        'descriptionBloc' => 'Actions à priorité critique.'
    ])
@endsection