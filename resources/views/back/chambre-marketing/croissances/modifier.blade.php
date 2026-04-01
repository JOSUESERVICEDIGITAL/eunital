@extends('back.layouts.principal')

@section('title', 'Modifier action de croissance')
@section('page_title', 'Chambre marketing · Modifier action de croissance')
@section('page_subtitle', 'Mise à jour des objectifs, leviers, priorités et plans de croissance.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-marketing.croissances.mettre_a_jour', $croissanceMarketing) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-marketing.croissances._formulaire', [
                'croissanceMarketing' => $croissanceMarketing,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-marketing.croissances.details', $croissanceMarketing) }}" class="btn btn-outline-dark rounded-pill px-4">
                    Retour
                </a>
            </div>
        </form>
    </div>
@endsection