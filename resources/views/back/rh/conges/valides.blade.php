@extends('back.layouts.principal')

@section('title', 'Congés validés')
@section('page_title', 'Congés validés')
@section('page_subtitle', 'Toutes les demandes validées dans la chambre RH.')

@section('content')
    @include('back.rh.conges._table-status', [
        'pageTitleInner' => 'Congés validés',
        'description' => 'Liste des congés déjà validés.',
        'congesList' => $conges,
        'showValidationActions' => false
    ])
@endsection