@extends('back.layouts.principal')
@section('title', 'Créer un message interne')
@section('page_title', 'Nouveau message interne')
@section('page_subtitle', 'Envoi d’une communication interne dans le hub.')
@section('content')
    <div class="content-card">
        <form method="POST" action="{{ route('back.equipe.messages.enregistrer') }}">
            @csrf
            @include('back.equipe.messages._formulaire', ['messageInterne' => null, 'membres' => $membres, 'departements' => $departements])

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Envoyer</button>
                <a href="{{ route('back.equipe.messages.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
            </div>
        </form>
    </div>
@endsection