@extends('back.layouts.principal')

@section('title', 'Modifier un membre')
@section('page_title', 'Modification du membre')
@section('page_subtitle', 'Mise à jour de la fiche membre et de sa position dans l’organisation.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <h4 class="fw-bold mb-4">Modifier le membre</h4>

                <form method="POST" action="{{ route('back.equipe.membres.mettre_a_jour', $membreEquipe) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('back.equipe.membres._formulaire', [
                        'membreEquipe' => $membreEquipe,
                        'utilisateurs' => $utilisateurs,
                        'departements' => $departements,
                        'postes' => $postes,
                        'responsables' => $responsables
                    ])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-warning rounded-pill px-4">Mettre à jour</button>
                        <a href="{{ route('back.equipe.membres.details', $membreEquipe) }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection