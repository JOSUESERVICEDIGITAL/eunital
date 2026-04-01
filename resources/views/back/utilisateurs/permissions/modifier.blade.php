@extends('back.layouts.principal')

@section('title', 'Modifier une permission')
@section('page_title', 'Modification de la permission')
@section('page_subtitle', 'Ajuste les caractéristiques de cette permission.')

@section('content')
    <div class="content-card">
        <h4 class="fw-bold mb-4">Modifier la permission</h4>

        <form method="POST" action="{{ route('back.permissions.mettre_a_jour', $permission) }}">
            @csrf
            @method('PUT')

            @include('back.utilisateurs.permissions._formulaire', ['permission' => $permission])

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                <a href="{{ route('back.permissions.details', $permission) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
            </div>
        </form>
    </div>
@endsection
