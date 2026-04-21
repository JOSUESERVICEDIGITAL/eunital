@extends('back.layouts.principal')

@section('title', 'Dossiers bien-être ouverts')
@section('page_title', 'Dossiers bien-être ouverts')
@section('page_subtitle', 'Tous les dossiers ouverts et en attente de prise en charge RH ou managériale.')

@section('content')
    @include('back.rh.bien-etre._table-status', [
        'pageTitleInner' => 'Dossiers ouverts',
        'description' => 'Tous les dossiers actuellement ouverts.',
        'dossiersList' => $dossiers
    ])
@endsection