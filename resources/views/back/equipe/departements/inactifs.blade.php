@extends('back.layouts.principal')
@section('title', 'Départements inactifs')
@section('page_title', 'Départements inactifs')
@section('page_subtitle', 'Départements momentanément inactifs.')
@section('content')
    @include('back.equipe.departements._liste-statut', [
        'departements' => $departements,
        'titreBloc' => 'Départements inactifs',
        'descriptionBloc' => 'Structures temporairement fermées.',
        'couleurBadge' => 'danger',
        'texteBadge' => 'Inactif'
    ])
@endsection