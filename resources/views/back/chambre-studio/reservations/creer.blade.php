@extends('back.layouts.principal')

@section('title', 'Nouvelle réservation studio')
@section('page_title', 'Créer une réservation studio')
@section('page_subtitle', 'Ajoute une nouvelle réservation de salle, cabine ou session dans le planning studio.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.reservations.enregistrer') }}">
                    @csrf

                    @include('back.chambre-studio.reservations._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-save me-1"></i> Enregistrer la réservation
                        </button>

                        <a href="{{ route('back.chambre-studio.reservations.toutes') }}" class="btn btn-light rounded-pill px-4">
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
                    Vérifie toujours les dates de début et de fin pour éviter les conflits de planning.
                </div>

                <div class="text-muted small mb-3">
                    Le statut recommandé au départ est <strong>réservée</strong>.
                </div>

                <div class="text-muted small">
                    Indique la salle utilisée pour faciliter l’organisation des espaces studio.
                </div>
            </div>
        </div>
    </div>
@endsection