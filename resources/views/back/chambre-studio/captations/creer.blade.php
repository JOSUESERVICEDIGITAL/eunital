@extends('back.layouts.principal')

@section('title', 'Nouvelle captation')
@section('page_title', 'Créer une captation studio')
@section('page_subtitle', 'Ajoute une nouvelle captation terrain pour mariage, concert, conférence ou événement.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.captations.enregistrer') }}">
                    @csrf

                    @include('back.chambre-studio.captations._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-save me-1"></i> Enregistrer la captation
                        </button>

                        <a href="{{ route('back.chambre-studio.captations.toutes') }}" class="btn btn-light rounded-pill px-4">
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
                    Associe la captation à un événement existant pour faciliter le suivi studio.
                </div>

                <div class="text-muted small mb-3">
                    Le statut recommandé au démarrage est <strong>planifiée</strong>.
                </div>

                <div class="text-muted small">
                    Utilise un titre clair pour retrouver facilement la captation dans le pipeline.
                </div>
            </div>
        </div>
    </div>
@endsection