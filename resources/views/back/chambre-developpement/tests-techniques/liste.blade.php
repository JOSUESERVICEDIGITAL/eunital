@extends('back.layouts.principal')

@section('title', 'Tests techniques')
@section('page_title', 'Chambre développement · Tests techniques')
@section('page_subtitle', 'Pilotage des tests fonctionnels, unitaires, d’intégration, de performance, de sécurité et de recette.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            @include('back.chambre-developpement.tests-techniques._liste-statut', [
                'tests' => $tests,
                'titreBloc' => 'Tests techniques',
                'descriptionBloc' => 'Vue centrale des tests planifiés, exécutés et analysés.'
            ])
        </div>
    </div>
@endsection
