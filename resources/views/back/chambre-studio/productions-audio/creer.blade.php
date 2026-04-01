@extends('back.layouts.principal')

@section('title', 'Nouvelle production audio')
@section('page_title', 'Créer une session audio')
@section('page_subtitle', 'Ajoute une nouvelle session d’enregistrement, de podcast, de chant ou d’instrumental.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.productions-audio.enregistrer') }}">
                    @csrf

                    @include('back.chambre-studio.productions-audio._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-save me-1"></i> Enregistrer la session
                        </button>

                        <a href="{{ route('back.chambre-studio.productions-audio.toutes') }}"
                            class="btn btn-light rounded-pill px-4">
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
                    Sélectionne le bon type de production audio pour mieux filtrer les sessions dans le pipeline.
                </div>

                <div class="text-muted small mb-3">
                    Associe si possible la session à un client et à un projet pour garder un historique propre.
                </div>

                <div class="text-muted small">
                    Le statut recommandé au démarrage est <strong>enregistrement</strong>.
                </div>
            </div>
        </div>
    </div>
@endsection