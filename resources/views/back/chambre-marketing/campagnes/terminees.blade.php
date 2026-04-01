@extends('back.layouts.principal')

@section('title', 'Campagnes terminées')
@section('page_title', 'Chambre marketing · Campagnes terminées')
@section('page_subtitle', 'Campagnes clôturées ou finalisées.')

@section('content')
    @include('back.chambre-marketing.campagnes._table', [
        'campagnes' => $campagnes,
        'titreBloc' => 'Campagnes terminées',
        'descriptionBloc' => 'Campagnes déjà finalisées.'
    ])
@endsection