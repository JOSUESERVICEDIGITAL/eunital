@extends('back.layouts.principal')

@section('title', 'Commentaires rejetés')
@section('page_title', 'Commentaires rejetés')
@section('page_subtitle', 'Commentaires refusés ou non conformes à la politique éditoriale.')

@section('content')
    @include('back.contenus.commentaires._liste-statut', [
        'titreBloc' => 'Commentaires rejetés',
        'descriptionBloc' => 'Ces commentaires ont été écartés par la modération.',
        'commentaires' => $commentaires,
        'couleurBadge' => 'danger',
        'texteBadge' => 'Rejeté'
    ])
@endsection