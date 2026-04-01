@extends('back.layouts.principal')

@section('title', 'API GraphQL')
@section('page_title', 'Chambre développement · API GraphQL')
@section('page_subtitle', 'Services GraphQL actuellement enregistrés dans la chambre.')

@section('content')
    @include('back.chambre-developpement.apis-integrations._liste-statut', [
        'apis' => $apis,
        'titreBloc' => 'API GraphQL',
        'descriptionBloc' => 'Services de type GraphQL.'
    ])
@endsection
