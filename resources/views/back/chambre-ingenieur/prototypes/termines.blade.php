@extends('back.layouts.principal')
@section('title', 'Prototypes terminés')
@section('page_title', 'Chambre d’ingénieurs · Prototypes terminés')
@section('page_subtitle', 'Prototypes achevés.')
@section('content')
    @include('back.chambre-ingenieur.prototypes._liste-statut', [
        'prototypes' => $prototypes,
        'titreBloc' => 'Prototypes terminés',
        'descriptionBloc' => 'Prototypes finalisés.'
    ])
@endsection