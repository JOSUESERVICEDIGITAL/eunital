@extends('back.layouts.principal')

@section('title', 'Ajouter un média')
@section('page_title', 'Nouveau média')
@section('page_subtitle', 'Ajout d’un fichier ou lien externe dans la bibliothèque du hub.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.medias.fichiers.enregistrer') }}" enctype="multipart/form-data">
            @csrf

            @include('back.medias.medias._formulaire', [
                'media' => null,
                'categoriesMedias' => $categoriesMedias,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.medias.fichiers.bibliotheque') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection