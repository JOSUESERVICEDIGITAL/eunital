@extends('back.layouts.principal')

@section('title', 'Articles brouillons')
@section('page_title', 'Articles brouillons')
@section('page_subtitle', 'Tous les contenus encore en préparation ou non finalisés.')

@section('content')
    @include('back.contenus.articles._liste-statut', [
        'titreBloc' => 'Articles brouillons',
        'descriptionBloc' => 'Surveillance des contenus en cours de rédaction.',
        'articles' => $articles,
        'couleurBadge' => 'warning',
        'texteBadge' => 'Brouillon'
    ])
@endsection