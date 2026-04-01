@extends('back.layouts.principal')

@section('title', 'Nouvelle création graphique')
@section('page_title', 'Créer une création graphique')
@section('page_subtitle', 'Ajoute une nouvelle création au pipeline de la chambre graphisme.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.creations.enregistrer') }}">
                    @csrf

                    @include('back.chambre-graphisme.creations-graphiques._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Enregistrer la création
                        </button>

                        <a href="{{ route('back.chambre-graphisme.creations.toutes') }}" class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Aide rapide</div>
                <h5 class="mb-3">Conseils graphisme</h5>

                <div class="text-muted small mb-3">
                    Associe la création à un client et à un projet quand cela est possible.
                </div>

                <div class="text-muted small mb-3">
                    Utilise le statut brouillon au démarrage pour garder un workflow propre.
                </div>

                <div class="text-muted small">
                    Renseigne le chemin du fichier ou son nom pour faciliter la récupération.
                </div>
            </div>
        </div>
    </div>
@endsection