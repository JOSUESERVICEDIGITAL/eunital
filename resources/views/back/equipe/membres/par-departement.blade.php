@extends('back.layouts.principal')

@section('title', 'Membres par département')
@section('page_title', 'Département : ' . $departement->nom)
@section('page_subtitle', 'Vue des membres rattachés à ce département.')

@section('content')
    @include('back.equipe.membres._liste-statut', [
        'membres' => $membres,
        'titreBloc' => 'Membres du département : ' . $departement->nom,
        'descriptionBloc' => 'Organisation des membres affectés à ce département.',
        'couleurBadge' => 'primary',
        'texteBadge' => 'Département'
    ])
@endsection