@extends('back.layouts.principal')

@section('title', 'Sites vitrines livrés')
@section('page_title', 'Chambre développement · Sites vitrines livrés')
@section('page_subtitle', 'Sites livrés au client ou validés pour mise en ligne.')

@section('content')
    @include('back.chambre-developpement.sites-vitrines._liste-statut', [
        'sites' => $sites,
        'titreBloc' => 'Sites livrés',
        'descriptionBloc' => 'Sites marqués comme livrés.'
    ])
@endsection
