@extends('back.layouts.principal')

@section('title', 'API actives')
@section('page_title', 'Chambre développement · API actives')
@section('page_subtitle', 'Services actuellement actifs et utilisés en production ou en intégration.')

@section('content')
    @include('back.chambre-developpement.apis-integrations._liste-statut', [
        'apis' => $apis,
        'titreBloc' => 'API actives',
        'descriptionBloc' => 'Services actuellement actifs.'
    ])
@endsection
