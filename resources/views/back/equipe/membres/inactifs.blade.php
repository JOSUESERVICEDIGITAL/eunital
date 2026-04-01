@extends('back.layouts.principal')

@section('title', 'Membres inactifs')
@section('page_title', 'Membres inactifs')
@section('page_subtitle', 'Vue filtrée des membres inactifs.')

@section('content')
    @include('back.equipe.membres._liste-statut', [
        'membres' => $membres,
        'titreBloc' => 'Membres inactifs',
        'descriptionBloc' => 'Membres temporairement hors activité.',
        'couleurBadge' => 'secondary',
        'texteBadge' => 'Inactif'
    ])
@endsection