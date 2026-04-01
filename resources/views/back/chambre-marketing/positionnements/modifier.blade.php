@extends('back.layouts.principal')

@section('title', 'Modifier positionnement')
@section('page_title', 'Chambre marketing · Modifier positionnement')
@section('page_subtitle', 'Mise à jour du message, de la cible, du canal principal et de la promesse.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.positionnements.mettre_a_jour', $positionnementMarketing) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-marketing.positionnements._formulaire', [
                'positionnementMarketing' => $positionnementMarketing,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-marketing.positionnements.details', $positionnementMarketing) }}" class="btn btn-outline-dark rounded-pill px-4">
                    Retour
                </a>
            </div>
        </form>
    </div>
@endsection