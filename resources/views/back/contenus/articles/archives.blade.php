@extends('back.layouts.principal')

@section('title', 'Articles archivés')
@section('page_title', 'Articles archivés')
@section('page_subtitle', 'Tous les contenus mis hors circulation ou conservés en archive.')

@section('content')
    @include('back.contenus.articles._liste-statut', [
        'titreBloc' => 'Articles archivés',
        'descriptionBloc' => 'Conservation des contenus retirés de la publication.',
        'articles' => $articles,
        'couleurBadge' => 'danger',
        'texteBadge' => 'Archivé'
    ])
@endsection