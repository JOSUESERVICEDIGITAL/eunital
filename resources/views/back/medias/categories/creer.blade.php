@extends('back.layouts.principal')
@section('title', 'Créer une catégorie média')
@section('page_title', 'Nouvelle catégorie média')
@section('page_subtitle', 'Création d’une nouvelle famille de classement pour les médias.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.medias.categories.enregistrer') }}">
            @csrf
            @include('back.medias.categories._formulaire', ['categorieMedia' => null])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.medias.categories.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection