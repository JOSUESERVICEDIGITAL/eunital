@extends('back.layouts.principal')
@section('title', 'Modifier application web')
@section('page_title', 'Chambre développement · Modifier une application web')
@section('page_subtitle', 'Mise à jour du projet, du statut, des URLs et de la stack.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.applications-web.mettre_a_jour', $applicationWeb) }}">
            @csrf
            @method('PUT')
            @include('back.chambre-developpement.applications-web._formulaire', ['applicationWeb' => $applicationWeb, 'utilisateurs' => $utilisateurs])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-developpement.applications-web.details', $applicationWeb) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection
