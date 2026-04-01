@extends('back.layouts.principal')

@section('title', 'Catégories inactives')
@section('page_title', 'Catégories inactives')
@section('page_subtitle', 'Toutes les catégories désactivées dans la chambre des contenus.')

@section('content')
    @include('back.contenus.categories._liste-statut', [
        'titreBloc' => 'Catégories inactives',
        'descriptionBloc' => 'Surveillance des catégories mises hors service.',
        'categories' => $categories,
        'couleurBadge' => 'danger',
        'texteBadge' => 'Inactive'
    ])
@endsection