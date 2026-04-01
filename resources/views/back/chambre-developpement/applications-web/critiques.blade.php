@extends('back.layouts.principal')
@section('title', 'Applications web critiques')
@section('page_title', 'Chambre développement · Applications web critiques')
@section('page_subtitle', 'Applications prioritaires ou sensibles.')
@section('content')
    @include('back.chambre-developpement.applications-web._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications critiques',
        'descriptionBloc' => 'Applications à priorité critique.'
    ])
@endsection
