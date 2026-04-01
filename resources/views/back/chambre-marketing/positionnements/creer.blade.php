@extends('back.layouts.principal')

@section('title', 'Nouveau positionnement')
@section('page_title', 'Chambre marketing · Nouveau positionnement')
@section('page_subtitle', 'Création d’un axe de positionnement marketing clair et différenciant.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.positionnements.enregistrer') }}">
            @csrf

            @include('back.chambre-marketing.positionnements._formulaire', [
                'positionnementMarketing' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-marketing.positionnements.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection