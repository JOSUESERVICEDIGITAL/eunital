@extends('back.layouts.principal')
@section('title', 'Liens sociaux header')
@section('page_title', 'Liens du header')
@section('page_subtitle', 'Liens affichés en haut du site ou partout.')
@section('content')
    @include('back.medias.liens-sociaux._liste-statut', [
        'liensSociaux' => $liensSociaux,
        'titreBloc' => 'Liens du header',
        'descriptionBloc' => 'Liens sociaux visibles dans le header ou partout.'
    ])
@endsection