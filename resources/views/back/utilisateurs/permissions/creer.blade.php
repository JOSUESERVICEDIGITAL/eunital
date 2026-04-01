@extends('back.layouts.principal')

@section('title', 'Créer une permission')
@section('page_title', 'Nouvelle permission')
@section('page_subtitle', 'Création d’une nouvelle capacité d’accès dans le hub.')

@section('content')
    <div class="content-card">
        <h4 class="fw-bold mb-4">Formulaire de création</h4>

        <form method="POST" action="{{ route('back.permissions.enregistrer') }}">
            @csrf

            @include('back.utilisateurs.permissions._formulaire', ['permission' => null])

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.permissions.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection
