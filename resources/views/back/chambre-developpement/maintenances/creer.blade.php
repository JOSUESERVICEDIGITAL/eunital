@extends('back.layouts.principal')

@section('title', 'Nouvelle maintenance')
@section('page_title', 'Chambre développement · Nouvelle maintenance')
@section('page_subtitle', 'Création d’une opération de maintenance, d’un correctif, d’une urgence ou d’une intervention technique.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.maintenances.enregistrer') }}">
            @csrf

            @include('back.chambre-developpement.maintenances._formulaire', [
                'maintenanceTechnique' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-developpement.maintenances.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection
