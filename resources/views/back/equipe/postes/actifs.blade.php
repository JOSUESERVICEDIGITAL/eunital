@extends('back.layouts.principal')
@section('title', 'Postes actifs')
@section('page_title', 'Postes actifs')
@section('page_subtitle', 'Postes actuellement disponibles.')
@section('content')
    @include('back.equipe.postes._liste-statut', [
        'postes' => $postes,
        'titreBloc' => 'Postes actifs',
        'descriptionBloc' => 'Fonctions actuellement ouvertes.',
        'couleurBadge' => 'success',
        'texteBadge' => 'Actif'
    ])
@endsection