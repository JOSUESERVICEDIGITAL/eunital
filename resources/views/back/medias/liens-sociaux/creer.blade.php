@extends('back.layouts.principal')
@section('title', 'Créer un lien social')
@section('page_title', 'Nouveau lien social')
@section('page_subtitle', 'Ajout d’un nouveau lien réseau ou présence web.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.medias.liens-sociaux.enregistrer') }}">
            @csrf
            @include('back.medias.liens-sociaux._formulaire', ['lienSocial' => null])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.medias.liens-sociaux.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection