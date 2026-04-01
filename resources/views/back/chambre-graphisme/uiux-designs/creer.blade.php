@extends('back.layouts.principal')

@section('title', 'Nouveau design UI/UX')
@section('page_title', 'Créer un design UI/UX')
@section('page_subtitle', 'Ajoute un nouveau wireframe, une maquette ou un prototype au pipeline UI/UX.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.uiux.enregistrer') }}">
                    @csrf

                    @include('back.chambre-graphisme.uiux-designs._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Enregistrer le design
                        </button>

                        <a href="{{ route('back.chambre-graphisme.uiux.toutes') }}" class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Aide rapide</div>
                <h5 class="mb-3">Conseils UI/UX</h5>

                <div class="text-muted small mb-3">
                    Choisis le bon type de livrable : wireframe, maquette ou prototype.
                </div>

                <div class="text-muted small mb-3">
                    Associe le design à un projet pour garder le suivi produit clair.
                </div>

                <div class="text-muted small">
                    Utilise le statut conception au début puis valide quand le design est prêt.
                </div>
            </div>
        </div>
    </div>
@endsection