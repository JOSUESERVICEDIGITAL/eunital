@extends('back.layouts.principal')

@section('title', 'Créer un département')
@section('page_title', 'Nouveau département')
@section('page_subtitle', 'Création d’une nouvelle branche organisationnelle du hub.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.equipe.departements.enregistrer') }}">
            @csrf
            @include('back.equipe.departements._formulaire', ['departement' => null])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.equipe.departements.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection