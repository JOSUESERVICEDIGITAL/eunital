@extends('back.layouts.principal')

@section('title', 'Sites vitrines maquettes')
@section('page_title', 'Chambre développement · Sites vitrines en maquette')
@section('page_subtitle', 'Sites actuellement au stade de conception graphique ou maquette.')

@section('content')
    @include('back.chambre-developpement.sites-vitrines._liste-statut', [
        'sites' => $sites,
        'titreBloc' => 'Sites en maquette',
        'descriptionBloc' => 'Projets encore en phase de conception visuelle.'
    ])
@endsection
