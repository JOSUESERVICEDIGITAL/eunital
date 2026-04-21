@extends('back.layouts.principal')

@section('title', 'Dossiers bien-être traités')
@section('page_title', 'Dossiers bien-être traités')
@section('page_subtitle', 'Tous les dossiers clôturés comme traités dans le cycle RH.')

@section('content')
    @include('back.rh.bien-etre._table-status', [
        'pageTitleInner' => 'Dossiers traités',
        'description' => 'Tous les dossiers marqués comme traités.',
        'dossiersList' => $dossiers
    ])
@endsection