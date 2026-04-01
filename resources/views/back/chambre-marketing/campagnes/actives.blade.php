@extends('back.layouts.principal')

@section('title', 'Campagnes actives')
@section('page_title', 'Chambre marketing · Campagnes actives')
@section('page_subtitle', 'Campagnes actuellement diffusées sur les réseaux.')

@section('content')
    @include('back.chambre-marketing.campagnes._table', [
        'campagnes' => $campagnes,
        'titreBloc' => 'Campagnes actives',
        'descriptionBloc' => 'Campagnes actuellement en diffusion.'
    ])
@endsection