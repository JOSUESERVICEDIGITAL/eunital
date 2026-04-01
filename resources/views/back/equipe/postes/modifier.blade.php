@extends('back.layouts.principal')
@section('title', 'Modifier un poste')
@section('page_title', 'Modification du poste')
@section('page_subtitle', 'Mise à jour des informations du poste.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.equipe.postes.mettre_a_jour', $poste) }}">
            @csrf
            @method('PUT')
            @include('back.equipe.postes._formulaire', ['poste' => $poste, 'departements' => $departements])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.equipe.postes.details', $poste) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection