@extends('back.layouts.principal')
@section('title', 'Modifier une catégorie média')
@section('page_title', 'Modification de la catégorie média')
@section('page_subtitle', 'Mise à jour des informations de la catégorie.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.medias.categories.mettre_a_jour', $categorieMedia) }}">
            @csrf
            @method('PUT')
            @include('back.medias.categories._formulaire', ['categorieMedia' => $categorieMedia])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.medias.categories.details', $categorieMedia) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection