@extends('back.layouts.principal')
@section('title', 'Nouvelle application web')
@section('page_title', 'Chambre développement · Nouvelle application web')
@section('page_subtitle', 'Création d’une nouvelle plateforme ou application web.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.applications-web.enregistrer') }}">
            @csrf
            @include('back.chambre-developpement.applications-web._formulaire', ['applicationWeb' => null, 'utilisateurs' => $utilisateurs])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-developpement.applications-web.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection
