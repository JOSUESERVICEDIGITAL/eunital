@extends('back.layouts.principal')
@section('title', 'Catégories média actives')
@section('page_title', 'Catégories média actives')
@section('page_subtitle', 'Vue filtrée des catégories actives.')
@section('content')
    @include('back.medias.categories._liste-statut', [
        'categoriesMedias' => $categoriesMedias,
        'titreBloc' => 'Catégories actives',
        'descriptionBloc' => 'Familles de médias actuellement utilisables.',
        'couleurBadge' => 'success',
        'texteBadge' => 'Active'
    ])
@endsection