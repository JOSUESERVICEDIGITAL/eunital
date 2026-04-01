@extends('back.layouts.principal')

@section('title', 'Modifier maintenance')
@section('page_title', 'Chambre développement · Modifier une maintenance')
@section('page_subtitle', 'Mise à jour du type, de l’urgence, du responsable et du statut de l’intervention.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.maintenances.mettre_a_jour', $maintenanceTechnique) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-developpement.maintenances._formulaire', [
                'maintenanceTechnique' => $maintenanceTechnique,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-developpement.maintenances.details', $maintenanceTechnique) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection
