@extends('back.layouts.principal')

@section('title', 'Congés refusés')
@section('page_title', 'Congés refusés')
@section('page_subtitle', 'Toutes les demandes refusées avec traçabilité de la décision RH.')

@section('content')
    @include('back.rh.conges._table-status', [
        'pageTitleInner' => 'Congés refusés',
        'description' => 'Liste des congés refusés.',
        'congesList' => $conges,
        'showValidationActions' => false
    ])
@endsection