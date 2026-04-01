@extends('back.layouts.principal')

@section('title', 'Rôles inactifs')
@section('page_title', 'Rôles inactifs')
@section('page_subtitle', 'Rôles désactivés ou temporairement indisponibles.')

@section('content')
    @include('back.utilisateurs.roles._liste-statut', [
        'roles' => $roles,
        'titreBloc' => 'Rôles inactifs',
        'descriptionBloc' => 'Vue des rôles mis hors service.',
        'couleurBadge' => 'danger',
        'texteBadge' => 'Inactif'
    ])
@endsection
