@extends('back.layouts.principal')

@section('title', 'Rôles actifs')
@section('page_title', 'Rôles actifs')
@section('page_subtitle', 'Rôles actuellement utilisables dans le hub.')

@section('content')
    @include('back.utilisateurs.roles._liste-statut', [
        'roles' => $roles,
        'titreBloc' => 'Rôles actifs',
        'descriptionBloc' => 'Vue des rôles activés et fonctionnels.',
        'couleurBadge' => 'success',
        'texteBadge' => 'Actif'
    ])
@endsection
