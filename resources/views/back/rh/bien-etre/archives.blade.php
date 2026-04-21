@extends('back.layouts.principal')

@section('title', 'Dossiers bien-être archivés')
@section('page_title', 'Dossiers bien-être archivés')
@section('page_subtitle', 'Historique archivé des dossiers de bien-être et de suivi humain.')

@section('content')
    @include('back.rh.bien-etre._table-status', [
        'pageTitleInner' => 'Dossiers archivés',
        'description' => 'Tous les dossiers archivés.',
        'dossiersList' => $dossiers
    ])
@endsection