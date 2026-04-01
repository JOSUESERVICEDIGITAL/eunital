@extends('back.layouts.principal')
@section('title', 'Applications hybrides')
@section('page_title', 'Chambre développement · Applications hybrides')
@section('page_subtitle', 'Applications Flutter, React Native et autres hybrides.')
@section('content')
    @include('back.chambre-developpement.applications-mobiles._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications hybrides',
        'descriptionBloc' => 'Projets mobiles hybrides.'
    ])
@endsection
