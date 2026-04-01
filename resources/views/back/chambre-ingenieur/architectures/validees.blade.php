@extends('back.layouts.principal')
@section('title', 'Architectures validées')
@section('page_title', 'Chambre d’ingénieurs · Architectures validées')
@section('page_subtitle', 'Architectures validées pour référence ou exécution.')
@section('content')
    @include('back.chambre-ingenieur.architectures._liste-statut', [
        'architectures' => $architectures,
        'titreBloc' => 'Architectures validées',
        'descriptionBloc' => 'Architectures reconnues comme structure de référence.'
    ])
@endsection