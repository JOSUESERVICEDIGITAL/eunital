@extends('back.layouts.principal')
@section('title', 'Applications Android')
@section('page_title', 'Chambre développement · Applications Android')
@section('page_subtitle', 'Applications mobiles destinées à Android.')
@section('content')
    @include('back.chambre-developpement.applications-mobiles._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications Android',
        'descriptionBloc' => 'Projets Android du hub.'
    ])
@endsection
