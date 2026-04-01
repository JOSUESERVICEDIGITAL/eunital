@extends('back.layouts.principal')

@section('title', 'Articles publiés')
@section('page_title', 'Articles publiés')
@section('page_subtitle', 'Tous les articles actuellement visibles publiquement.')

@section('content')
    @include('back.contenus.articles._liste-statut', [
        'titreBloc' => 'Articles publiés',
        'descriptionBloc' => 'Suivi des contenus déjà mis en ligne.',
        'articles' => $articles,
        'couleurBadge' => 'success',
        'texteBadge' => 'Publié'
    ])
@endsection