@extends('back.layouts.principal')
@section('title', 'Dossiers publiés')
@section('page_title', 'Chambre d’ingénieurs · Dossiers publiés')
@section('page_subtitle', 'Dossiers publiés et disponibles comme référence.')
@section('content')
    @include('back.chambre-ingenieur.dossiers._liste-statut', [
        'dossiers' => $dossiers,
        'titreBloc' => 'Dossiers publiés',
        'descriptionBloc' => 'Dossiers officiellement publiés.'
    ])
@endsection