@extends('back.layouts.principal')

@section('title', 'Recrutements fermés')
@section('page_title', 'Recrutements fermés')
@section('page_subtitle', 'Campagnes clôturées et sorties du flux actif.')

@section('content')
    @include('back.rh.recrutements._table-status', [
        'pageTitleInner' => 'Recrutements fermés',
        'description' => 'Toutes les campagnes clôturées.',
        'recrutementsList' => $recrutements
    ])
@endsection