@extends('back.layouts.principal')
@section('title', 'Applications web en test')
@section('page_title', 'Chambre développement · Applications web en test')
@section('page_subtitle', 'Applications passées en phase de validation.')
@section('content')
    @include('back.chambre-developpement.applications-web._liste-statut', [
        'applications' => $applications,
        'titreBloc' => 'Applications en test',
        'descriptionBloc' => 'Applications en cours de test technique ou fonctionnel.'
    ])
@endsection
