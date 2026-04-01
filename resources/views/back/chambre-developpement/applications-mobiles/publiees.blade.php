@extends('back.layouts.principal')
@section('title', 'Applications mobiles publiées')
@section('page_title', 'Chambre développement · Applications mobiles publiées')
@section('page_subtitle', 'Applications déjà publiées ou déployées.')
@section('content')
    @include('back.chambre-developpement.applications-mobiles._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications publiées',
        'descriptionBloc' => 'Applications mobiles publiées.'
    ])
@endsection
