@extends('back.layouts.principal')
@section('title', 'Applications web en ligne')
@section('page_title', 'Chambre développement · Applications web en ligne')
@section('page_subtitle', 'Applications actives en production.')
@section('content')
    @include('back.chambre-developpement.applications-web._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications en ligne',
        'descriptionBloc' => 'Applications actuellement disponibles en production.'
    ])
@endsection
