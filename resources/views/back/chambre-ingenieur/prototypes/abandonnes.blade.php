@extends('back.layouts.principal')
@section('title', 'Prototypes abandonnés')
@section('page_title', 'Chambre d’ingénieurs · Prototypes abandonnés')
@section('page_subtitle', 'Prototypes arrêtés ou abandonnés.')
@section('content')
    @include('back.chambre-ingenieur.prototypes._liste-statut', [
        'prototypes' => $prototypes,
        'titreBloc' => 'Prototypes abandonnés',
        'descriptionBloc' => 'Prototypes sortis du cycle actif.'
    ])
@endsection