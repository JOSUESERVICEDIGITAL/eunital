@extends('back.layouts.principal')

@section('title', 'Campagnes multi-réseaux')
@section('page_title', 'Chambre marketing · Campagnes multi-réseaux')
@section('page_subtitle', 'Campagnes diffusées sur plusieurs plateformes à la fois.')

@section('content')
    @include('back.chambre-marketing.campagnes._table', [
        'campagnes' => $campagnes,
        'titreBloc' => 'Campagnes multi-réseaux',
        'descriptionBloc' => 'Campagnes avec diffusion simultanée sur plusieurs réseaux.'
    ])
@endsection