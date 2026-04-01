@extends('back.layouts.principal')

@section('title', 'Commentaires en attente')
@section('page_title', 'Commentaires en attente')
@section('page_subtitle', 'Commentaires en cours de modération avant décision.')

@section('content')
    @include('back.contenus.commentaires._liste-statut', [
        'titreBloc' => 'Commentaires en attente',
        'descriptionBloc' => 'Ces commentaires doivent encore être examinés.',
        'commentaires' => $commentaires,
        'couleurBadge' => 'warning',
        'texteBadge' => 'En attente'
    ])
@endsection