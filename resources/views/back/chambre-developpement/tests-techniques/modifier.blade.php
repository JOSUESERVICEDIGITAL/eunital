@extends('back.layouts.principal')

@section('title', 'Modifier test technique')
@section('page_title', 'Chambre développement · Modifier un test technique')
@section('page_subtitle', 'Mise à jour du type, du résultat, de l’environnement et du statut du test.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.tests-techniques.mettre_a_jour', $testTechnique) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-developpement.tests-techniques._formulaire', [
                'testTechnique' => $testTechnique,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-developpement.tests-techniques.details', $testTechnique) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection
