@extends('back.layouts.principal')

@section('title', 'Nouvelle commande studio')
@section('page_title', 'Créer une commande studio')
@section('page_subtitle', 'Ajoute une nouvelle demande client pour production, captation ou prestation studio.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.commandes.enregistrer') }}">
                    @csrf

                    @include('back.chambre-studio.commandes._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-save me-1"></i> Enregistrer la commande
                        </button>

                        <a href="{{ route('back.chambre-studio.commandes.toutes') }}" class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Aide rapide</div>
                <h5 class="mb-3">Conseils studio</h5>

                <div class="text-muted small mb-3">
                    Associe toujours la commande à un client existant pour faciliter le suivi.
                </div>

                <div class="text-muted small mb-3">
                    Le statut recommandé au départ est <strong>en attente</strong>.
                </div>

                <div class="text-muted small">
                    Décris bien les besoins du client pour faciliter la production et la livraison.
                </div>
            </div>
        </div>
    </div>
@endsection