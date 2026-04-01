@extends('back.layouts.principal')
@section('title', 'Applications iOS')
@section('page_title', 'Chambre développement · Applications iOS')
@section('page_subtitle', 'Applications mobiles destinées à iOS.')
@section('content')
    @include('back.chambre-developpement.applications-mobiles._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications iOS',
        'descriptionBloc' => 'Projets iOS du hub.'
    ])
@endsection
