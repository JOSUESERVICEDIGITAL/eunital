@extends('back.layouts.principal')

@section('title', 'Campagnes en pause')
@section('page_title', 'Chambre marketing · Campagnes en pause')
@section('page_subtitle', 'Campagnes temporairement suspendues.')

@section('content')
    @include('back.chambre-marketing.campagnes._table', [
        'campagnes' => $campagnes,
        'titreBloc' => 'Campagnes en pause',
        'descriptionBloc' => 'Campagnes momentanément arrêtées.'
    ])
@endsection