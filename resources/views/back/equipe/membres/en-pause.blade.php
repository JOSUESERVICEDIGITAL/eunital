@extends('back.layouts.principal')

@section('title', 'Membres en pause')
@section('page_title', 'Membres en pause')
@section('page_subtitle', 'Vue filtrée des membres en pause.')

@section('content')
    @include('back.equipe.membres._liste-statut', [
        'membres' => $membres,
        'titreBloc' => 'Membres en pause',
        'descriptionBloc' => 'Membres momentanément en pause dans l’organisation.',
        'couleurBadge' => 'warning',
        'texteBadge' => 'En pause'
    ])
@endsection