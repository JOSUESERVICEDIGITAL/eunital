@extends('back.layouts.principal')
@section('title', 'Nouvelle application mobile')
@section('page_title', 'Chambre développement · Nouvelle application mobile')
@section('page_subtitle', 'Création d’un projet Android, iOS, hybride ou PWA.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-developpement.applications-mobiles.enregistrer') }}">
            @csrf
            @include('back.chambre-developpement.applications-mobiles._formulaire', ['applicationMobile' => null, 'utilisateurs' => $utilisateurs])
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-developpement.applications-mobiles.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection
