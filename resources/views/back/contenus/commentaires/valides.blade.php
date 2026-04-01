@extends('back.layouts.principal')

@section('title', 'Commentaires validés')
@section('page_title', 'Commentaires validés')
@section('page_subtitle', 'Commentaires approuvés et acceptés dans le système.')

@section('content')
    @include('back.contenus.commentaires._liste-statut', [
        'titreBloc' => 'Commentaires validés',
        'descriptionBloc' => 'Ces commentaires ont été acceptés par la modération.',
        'commentaires' => $commentaires,
        'couleurBadge' => 'success',
        'texteBadge' => 'Validé'
    ])
@endsection