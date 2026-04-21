@extends('back.layouts.principal')

@section('title', 'Sanctions archivées')
@section('page_title', 'Sanctions archivées')
@section('page_subtitle', 'Historique archivé des sanctions disciplinaires de l’organisation.')

@section('content')
    @include('back.rh.sanctions._table-status', [
        'pageTitleInner' => 'Sanctions archivées',
        'description' => 'Toutes les sanctions archivées.',
        'sanctionsList' => $sanctions
    ])
@endsection