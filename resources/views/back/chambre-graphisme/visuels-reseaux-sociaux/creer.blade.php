@extends('back.layouts.principal')

@section('title', 'Nouveau visuel social')
@section('page_title', 'Créer un visuel réseau social')
@section('page_subtitle', 'Ajoute un nouveau contenu visuel destiné aux réseaux sociaux.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.social.enregistrer') }}">
                    @csrf

                    @include('back.chambre-graphisme.visuels-reseaux-sociaux._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Enregistrer le visuel
                        </button>

                        <a href="{{ route('back.chambre-graphisme.social.toutes') }}" class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Aide rapide</div>
                <h5 class="mb-3">Conseils social media</h5>

                <div class="text-muted small mb-3">
                    Choisis la bonne plateforme pour adapter ton format et ta publication.
                </div>

                <div class="text-muted small mb-3">
                    Utilise le statut programmé dès qu’une date de diffusion est définie.
                </div>

                <div class="text-muted small">
                    Renseigne le fichier final pour centraliser les livrables sociaux.
                </div>
            </div>
        </div>
    </div>
@endsection