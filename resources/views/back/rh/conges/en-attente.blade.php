@extends('back.layouts.principal')

@section('title', 'Congés en attente')
@section('page_title', 'Congés en attente')
@section('page_subtitle', 'Demandes à traiter en priorité avec accès rapide à la validation et au refus.')

@section('content')
    @include('back.rh.conges._table-status', [
        'pageTitleInner' => 'Demandes en attente',
        'description' => 'Toutes les demandes de congé en attente de décision.',
        'congesList' => $conges,
        'showValidationActions' => true
    ])
@endsection