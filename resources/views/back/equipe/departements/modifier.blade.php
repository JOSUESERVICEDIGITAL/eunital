@extends('back.layouts.principal')

@section('title', 'Modifier un département')
@section('page_title', 'Modification du département')
@section('page_subtitle', 'Mets à jour les informations du département.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.equipe.departements.mettre_a_jour', $departement) }}">
            @csrf
            @method('PUT')
            @include('back.equipe.departements._formulaire', ['departement' => $departement])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.equipe.departements.details', $departement) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection