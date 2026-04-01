@extends('back.layouts.principal')
@section('title', 'Études défavorables')
@section('page_title', 'Chambre d’ingénieurs · Études défavorables')
@section('page_subtitle', 'Études concluant à une non-faisabilité.')
@section('content')
    @include('back.chambre-ingenieur.etudes._liste-statut', [
        'etudes' => $etudes,
        'titreBloc' => 'Études défavorables',
        'descriptionBloc' => 'Études concluant à une issue défavorable.'
    ])
@endsection