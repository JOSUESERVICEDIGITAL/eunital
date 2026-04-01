@extends('back.layouts.principal')
@section('title', 'Modifier un message')
@section('page_title', 'Modification du message')
@section('page_subtitle', 'Mets à jour le contenu ou les paramètres du message interne.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.equipe.messages.mettre_a_jour', $messageInterne) }}">
            @csrf
            @method('PUT')
            @include('back.equipe.messages._formulaire', ['messageInterne' => $messageInterne, 'membres' => $membres, 'departements' => $departements])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.equipe.messages.details', $messageInterne) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection