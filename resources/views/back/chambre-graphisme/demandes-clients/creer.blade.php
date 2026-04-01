@extends('back.layouts.principal')

@section('title', 'Nouvelle demande client')
@section('page_title', 'Créer une demande client')
@section('page_subtitle', 'Ajoute un nouveau brief ou besoin graphique transmis par un client.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.clients-demandes.enregistrer') }}">
                    @csrf

                    @include('back.chambre-graphisme.demandes-clients._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Enregistrer la demande
                        </button>

                        <a href="{{ route('back.chambre-graphisme.clients-demandes.toutes') }}" class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Aide rapide</div>
                <h5 class="mb-3">Conseils brief client</h5>

                <div class="text-muted small mb-3">
                    Sois précis dans la description pour éviter les allers-retours inutiles.
                </div>

                <div class="text-muted small mb-3">
                    Définis bien la priorité afin d’aider la planification de l’équipe.
                </div>

                <div class="text-muted small">
                    Garde le statut en attente tant que la demande n’a pas été officiellement lancée.
                </div>
            </div>
        </div>
    </div>
@endsection
