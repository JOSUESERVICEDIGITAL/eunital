@extends('back.layouts.principal')

@section('title', 'Dossiers bien-être en cours')
@section('page_title', 'Dossiers bien-être en cours')
@section('page_subtitle', 'Dossiers déjà pris en charge et actuellement en traitement.')

@section('content')
    @include('back.rh.bien-etre._table-status', [
        'pageTitleInner' => 'Dossiers en cours',
        'description' => 'Tous les dossiers actuellement en traitement.',
        'dossiersList' => $dossiers
    ])
@endsection