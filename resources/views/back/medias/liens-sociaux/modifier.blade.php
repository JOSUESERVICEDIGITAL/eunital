@extends('back.layouts.principal')
@section('title', 'Modifier un lien social')
@section('page_title', 'Modification du lien social')
@section('page_subtitle', 'Mise à jour du lien, de son icône et de sa position.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.medias.liens-sociaux.mettre_a_jour', $lienSocial) }}">
            @csrf
            @method('PUT')
            @include('back.medias.liens-sociaux._formulaire', ['lienSocial' => $lienSocial])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.medias.liens-sociaux.details', $lienSocial) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection