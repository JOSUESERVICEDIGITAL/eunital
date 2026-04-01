@extends('back.layouts.principal')
@section('title', 'Liens sociaux actifs')
@section('page_title', 'Liens sociaux actifs')
@section('page_subtitle', 'Liens actuellement actifs sur le site.')
@section('content')
    @include('back.medias.liens-sociaux._liste-statut', [
        'liensSociaux' => $liensSociaux,
        'titreBloc' => 'Liens actifs',
        'descriptionBloc' => 'Liens sociaux actuellement visibles.'
    ])
@endsection