@extends('back.layouts.principal')

@section('title', 'Membres actifs')
@section('page_title', 'Membres actifs')
@section('page_subtitle', 'Vue filtrée des membres actifs.')

@section('content')
    @include('back.equipe.membres._liste-statut', [
        'membres' => $membres,
        'titreBloc' => 'Membres actifs',
        'descriptionBloc' => 'Membres actuellement en activité dans le hub.',
        'couleurBadge' => 'success',
        'texteBadge' => 'Actif'
    ])
@endsection