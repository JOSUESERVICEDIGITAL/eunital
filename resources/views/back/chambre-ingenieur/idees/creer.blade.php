@extends('back.layouts.principal')

@section('title', 'Nouvelle idée')
@section('page_title', 'Chambre d’ingénieurs · Nouvelle idée')
@section('page_subtitle', 'Enregistrement d’une nouvelle idée ou proposition d’ingénierie.')

@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.chambre-ingenieur.idees.enregistrer') }}">
            @csrf
            @include('back.chambre-ingenieur.idees._formulaire', [
                'ideeIngenieurie' => null,
                'utilisateurs' => $utilisateurs
            ])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                <a href="{{ route('back.chambre-ingenieur.idees.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection