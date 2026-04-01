@extends('back.layouts.principal')

@section('title', 'Nouvelle action de croissance')
@section('page_title', 'Chambre marketing · Nouvelle action de croissance')
@section('page_subtitle', 'Création d’une nouvelle action ou levier de croissance marketing.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.croissances.enregistrer') }}">
            @csrf

            @include('back.chambre-marketing.croissances._formulaire', [
                'croissanceMarketing' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-marketing.croissances.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection