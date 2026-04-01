@extends('back.layouts.principal')

@section('title', 'Modifier une idée')
@section('page_title', 'Chambre d’ingénieurs · Modifier une idée')
@section('page_subtitle', 'Mise à jour d’une idée, de sa priorité, de son responsable et de sa progression.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.idees.mettre_a_jour', $ideeIngenieurie) }}">
            @csrf
            @method('PUT')

            @include('back.chambre-ingenieur.idees._formulaire', [
                'ideeIngenieurie' => $ideeIngenieurie,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.chambre-ingenieur.idees.details', $ideeIngenieurie) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection