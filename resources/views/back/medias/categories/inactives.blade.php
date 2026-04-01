@extends('back.layouts.principal')
@section('title', 'Catégories média inactives')
@section('page_title', 'Catégories média inactives')
@section('page_subtitle', 'Vue filtrée des catégories inactives.')
@section('content')
    @include('back.medias.categories._liste-statut', [
        'categoriesMedias' => $categoriesMedias,
        'titreBloc' => 'Catégories inactives',
        'descriptionBloc' => 'Familles de médias temporairement désactivées.',
        'couleurBadge' => 'danger',
        'texteBadge' => 'Inactive'
    ])
@endsection