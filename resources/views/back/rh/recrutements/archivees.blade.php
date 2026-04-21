@extends('back.layouts.principal')

@section('title', 'Recrutements archivés')
@section('page_title', 'Recrutements archivés')
@section('page_subtitle', 'Historique archivé des campagnes de recrutement du hub RH.')

@section('content')
    @include('back.rh.recrutements._table-status', [
        'pageTitleInner' => 'Recrutements archivés',
        'description' => 'Toutes les campagnes archivées.',
        'recrutementsList' => $recrutements
    ])
@endsection