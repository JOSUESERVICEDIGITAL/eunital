@extends('back.layouts.principal')
@section('title', 'Départements actifs')
@section('page_title', 'Départements actifs')
@section('page_subtitle', 'Départements actuellement actifs.')
@section('content')
    @include('back.equipe.departements._liste-statut', [
        'departements' => $departements,
        'titreBloc' => 'Départements actifs',
        'descriptionBloc' => 'Structures actuellement ouvertes et utilisées.',
        'couleurBadge' => 'success',
        'texteBadge' => 'Actif'
    ])
@endsection