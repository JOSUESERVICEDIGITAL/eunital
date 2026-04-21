@extends('back.layouts.principal')

@section('title', 'Congés annulés')
@section('page_title', 'Congés annulés')
@section('page_subtitle', 'Demandes annulées et retirées du flux actif.')

@section('content')
    @include('back.rh.conges._table-status', [
        'pageTitleInner' => 'Congés annulés',
        'description' => 'Liste des congés annulés.',
        'congesList' => $conges,
        'showValidationActions' => false
    ])
@endsection