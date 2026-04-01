@extends('back.layouts.principal')

@section('title', 'Nouvelle maquette graphique')
@section('page_title', 'Créer une maquette graphique')
@section('page_subtitle', 'Ajoute un nouveau mockup ou support de présentation au pipeline graphique.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.maquettes.enregistrer') }}">
                    @csrf

                    @include('back.chambre-graphisme.maquettes-graphiques._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Enregistrer la maquette
                        </button>

                        <a href="{{ route('back.chambre-graphisme.maquettes.toutes') }}" class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Aide rapide</div>
                <h5 class="mb-3">Conseils mockup</h5>

                <div class="text-muted small mb-3">
                    Indique clairement le support pour mieux classer les maquettes.
                </div>

                <div class="text-muted small mb-3">
                    Utilise le statut création jusqu’à la version prête à validation.
                </div>

                <div class="text-muted small">
                    Renseigne le fichier source ou l’export final pour garder la traçabilité.
                </div>
            </div>
        </div>
    </div>
@endsection