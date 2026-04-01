@extends('back.layouts.principal')

@section('title', 'Nouvelle image de marque')
@section('page_title', 'Chambre marketing · Nouvelle image de marque')
@section('page_subtitle', 'Création d’une nouvelle identité de marque, slogan ou charte pour le hub.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.images-marque.enregistrer') }}">
            @csrf

            @include('back.chambre-marketing.images-marque._formulaire', [
                'imageMarque' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-marketing.images-marque.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection