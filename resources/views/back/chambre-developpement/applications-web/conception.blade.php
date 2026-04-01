@extends('back.layouts.principal')
@section('title', 'Applications web en conception')
@section('page_title', 'Chambre développement · Applications web en conception')
@section('page_subtitle', 'Applications encore au stade de cadrage et conception.')
@section('content')
    @include('back.chambre-developpement.applications-web._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications en conception',
        'descriptionBloc' => 'Projets encore en cadrage fonctionnel ou technique.'
    ])
@endsection
