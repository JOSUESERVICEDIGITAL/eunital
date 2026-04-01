@extends('back.layouts.principal')

@section('title', 'Modifier un média')
@section('page_title', 'Modification du média')
@section('page_subtitle', 'Mise à jour du contenu, de la catégorie et des réglages du média.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.medias.fichiers.mettre_a_jour', $media) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('back.medias.medias._formulaire', [
                'media' => $media,
                'categoriesMedias' => $categoriesMedias,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.medias.fichiers.details', $media) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection