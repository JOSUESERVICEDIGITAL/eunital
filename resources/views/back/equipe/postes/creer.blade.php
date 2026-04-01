@extends('back.layouts.principal')
@section('title', 'Créer un poste')
@section('page_title', 'Nouveau poste')
@section('page_subtitle', 'Création d’une nouvelle fonction dans le hub.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.equipe.postes.enregistrer') }}">
            @csrf
            @include('back.equipe.postes._formulaire', ['poste' => null, 'departements' => $departements])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.equipe.postes.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection