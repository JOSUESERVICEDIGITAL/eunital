@extends('back.layouts.principal')

@section('title', 'API REST')
@section('page_title', 'Chambre développement · API REST')
@section('page_subtitle', 'Services REST actuellement enregistrés dans la chambre.')

@section('content')
    @include('back.chambre-developpement.apis-integrations._liste-statut', [
        'apis' => $apis,
        'titreBloc' => 'API REST',
        'descriptionBloc' => 'Services de type REST.'
    ])
@endsection
