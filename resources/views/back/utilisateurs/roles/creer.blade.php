@extends('back.layouts.principal')

@section('title', 'Créer un rôle')
@section('page_title', 'Nouveau rôle')
@section('page_subtitle', 'Création d’un nouveau profil d’accès pour le hub.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <h4 class="fw-bold mb-4">Formulaire de création</h4>

                <form method="POST" action="{{ route('back.roles.enregistrer') }}">
                    @csrf

                    @include('back.utilisateurs.roles._formulaire', ['role' => null])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                        <a href="{{ route('back.roles.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
