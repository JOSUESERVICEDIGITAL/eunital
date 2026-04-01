@extends('back.layouts.principal')

@section('title', 'Ajouter un membre')
@section('page_title', 'Nouveau membre')
@section('page_subtitle', 'Ajout d’un nouveau membre dans l’organisation interne du hub.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <h4 class="fw-bold mb-4">Formulaire de création</h4>

                <form method="POST" action="{{ route('back.equipe.membres.enregistrer') }}" enctype="multipart/form-data">
                    @csrf

                    @include('back.equipe.membres._formulaire', [
                        'membreEquipe' => null,
                        'utilisateurs' => $utilisateurs,
                        'departements' => $departements,
                        'postes' => $postes,
                        'responsables' => $responsables
                    ])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                        <a href="{{ route('back.equipe.membres.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection