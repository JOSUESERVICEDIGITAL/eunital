@extends('back.layouts.principal')
@section('title', 'Liens sociaux footer')
@section('page_title', 'Liens du footer')
@section('page_subtitle', 'Liens affichés dans le footer ou partout.')
@section('content')
    @include('back.medias.liens-sociaux._liste-statut', [
        'liensSociaux' => $liensSociaux,
        'titreBloc' => 'Liens du footer',
        'descriptionBloc' => 'Liens sociaux visibles dans le footer ou partout.'
    ])
@endsection