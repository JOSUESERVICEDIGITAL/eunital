@extends('back.layouts.principal')

@section('title', 'Modifier un rôle')
@section('page_title', 'Modification du rôle')
@section('page_subtitle', 'Ajuste les propriétés et la définition de ce rôle.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <h4 class="fw-bold mb-4">Modifier le rôle</h4>

                <form method="POST" action="{{ route('back.roles.mettre_a_jour', $role) }}">
                    @csrf
                    @method('PUT')

                    @include('back.utilisateurs.roles._formulaire', ['role' => $role])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                        <a href="{{ route('back.roles.details', $role) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
