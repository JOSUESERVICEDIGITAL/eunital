@extends('back.layouts.principal')
@section('title', 'Postes inactifs')
@section('page_title', 'Postes inactifs')
@section('page_subtitle', 'Postes momentanément indisponibles.')
@section('content')
    @include('back.equipe.postes._liste-statut', [
        'postes' => $postes,
        'titreBloc' => 'Postes inactifs',
        'descriptionBloc' => 'Fonctions actuellement fermées.',
        'couleurBadge' => 'danger',
        'texteBadge' => 'Inactif'
    ])
@endsection