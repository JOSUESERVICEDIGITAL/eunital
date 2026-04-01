@extends('back.layouts.principal')
@section('title', 'Dossiers archivés')
@section('page_title', 'Chambre d’ingénieurs · Dossiers archivés')
@section('page_subtitle', 'Dossiers archivés de la chambre.')
@section('content')
    @include('back.chambre-ingenieur.dossiers._liste-statut', [
        'dossiers' => $dossiers,
        'titreBloc' => 'Dossiers archivés',
        'descriptionBloc' => 'Dossiers sortis du circuit actif.'
    ])
@endsection