@extends('back.layouts.principal')
@section('title', 'Modifier application mobile')
@section('page_title', 'Chambre développement · Modifier une application mobile')
@section('page_subtitle', 'Mise à jour de la plateforme, du statut et de la stack.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.applications-mobiles.mettre_a_jour', $applicationMobile) }}">
            @csrf
            @method('PUT')
            @include('back.chambre-developpement.applications-mobiles._formulaire', ['applicationMobile' => $applicationMobile, 'utilisateurs' => $utilisateurs])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-developpement.applications-mobiles.details', $applicationMobile) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection
