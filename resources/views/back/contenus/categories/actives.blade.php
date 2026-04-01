@extends('back.layouts.principal')

@section('title', 'Catégories actives')
@section('page_title', 'Catégories actives')
@section('page_subtitle', 'Toutes les catégories actuellement actives dans la chambre des contenus.')

@section('content')
    @include('back.contenus.categories._liste-statut', [
        'titreBloc' => 'Catégories actives',
        'descriptionBloc' => 'Surveillance des catégories utilisables dans le système.',
        'categories' => $categories,
        'couleurBadge' => 'success',
        'texteBadge' => 'Active'
    ])
@endsection