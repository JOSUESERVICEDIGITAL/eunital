@extends('back.layouts.principal')

@section('title', 'Modifier image de marque')
@section('page_title', 'Chambre marketing · Modifier image de marque')
@section('page_subtitle', 'Mise à jour du ton, du slogan, des couleurs, du logo et des lignes de communication.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.images-marque.mettre_a_jour', $imageMarque) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-marketing.images-marque._formulaire', [
                'imageMarque' => $imageMarque,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-marketing.images-marque.details', $imageMarque) }}" class="btn btn-outline-dark rounded-pill px-4">
                    Retour
                </a>
            </div>
        </form>
    </div>
@endsection