@extends('back.layouts.principal')

@section('title', 'Nouveau test technique')
@section('page_title', 'Chambre développement · Nouveau test technique')
@section('page_subtitle', 'Création d’un test fonctionnel, unitaire, d’intégration, de sécurité ou de performance.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.tests-techniques.enregistrer') }}">
            @csrf

            @include('back.chambre-developpement.tests-techniques._formulaire', [
                'testTechnique' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-developpement.tests-techniques.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection
