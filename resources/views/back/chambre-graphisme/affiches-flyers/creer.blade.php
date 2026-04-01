@extends('back.layouts.principal')

@section('title', 'Nouveau support graphique')
@section('page_title', 'Créer une affiche ou un flyer')
@section('page_subtitle', 'Ajoute un nouveau support imprimé ou promotionnel au pipeline graphique.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.affiches.enregistrer') }}">
                    @csrf

                    @include('back.chambre-graphisme.affiches-flyers._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Enregistrer le support
                        </button>

                        <a href="{{ route('back.chambre-graphisme.affiches.toutes') }}" class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Aide rapide</div>
                <h5 class="mb-3">Conseils impression</h5>

                <div class="text-muted small mb-3">
                    Choisis bien entre affiche et flyer selon le support de diffusion attendu.
                </div>

                <div class="text-muted small mb-3">
                    Garde le statut en création jusqu’à la validation finale du support.
                </div>

                <div class="text-muted small">
                    Indique le chemin ou le nom du fichier final pour un suivi plus simple.
                </div>
            </div>
        </div>
    </div>
@endsection