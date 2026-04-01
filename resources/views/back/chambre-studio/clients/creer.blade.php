@extends('back.layouts.principal')

@section('title', 'Nouveau client studio')
@section('page_title', 'Créer un client studio')
@section('page_subtitle', 'Ajoute un artiste, une entreprise ou un particulier dans la base client du studio.')

@section('content')
    <div class="row g-4">

        {{-- FORMULAIRE --}}
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.clients.enregistrer') }}">
                    @csrf

                    @include('back.chambre-studio.clients._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-save me-1"></i> Enregistrer le client
                        </button>

                        <a href="{{ route('back.chambre-studio.clients.tous') }}"
                           class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- AIDE / UX --}}
        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Conseils</div>
                <h5 class="mb-3">Ajout client</h5>

                <div class="text-muted small mb-3">
                    ✔ Choisis bien le type de client :
                    <strong>artiste</strong>, <strong>entreprise</strong> ou <strong>particulier</strong>.
                </div>

                <div class="text-muted small mb-3">
                    ✔ Renseigne le téléphone pour faciliter les contacts rapides lors des sessions studio.
                </div>

                <div class="text-muted small mb-3">
                    ✔ L’email permet l’envoi automatique des livrables (audio, vidéo, factures).
                </div>

                <div class="text-muted small">
                    ✔ Tu pourras modifier ce client plus tard depuis sa fiche détaillée.
                </div>
            </div>

            {{-- BONUS UX --}}
            <div class="content-card mt-4">
                <div class="mini-label">Types de clients</div>
                <h6 class="mb-3">Classification</h6>

                <div class="d-flex flex-column gap-2 small text-muted">
                    <div>🎤 Artiste → chanteur, rappeur, groupe</div>
                    <div>🏢 Entreprise → marque, agence, société</div>
                    <div>👤 Particulier → mariage, événement privé</div>
                </div>
            </div>
        </div>

    </div>
@endsection
