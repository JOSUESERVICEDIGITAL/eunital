@extends('back.layouts.principal')

@section('title', 'Nouvelle identité visuelle')
@section('page_title', 'Créer une identité visuelle')
@section('page_subtitle', 'Ajoute une nouvelle identité visuelle au pipeline de la chambre graphisme.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.identites.enregistrer') }}">
                    @csrf

                    @include('back.chambre-graphisme.identites-visuelles._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Enregistrer l’identité
                        </button>

                        <a href="{{ route('back.chambre-graphisme.identites.toutes') }}" class="btn btn-light rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Aide rapide</div>
                <h5 class="mb-3">Conseils branding</h5>

                <div class="text-muted small mb-3">
                    Définis clairement la palette, la typographie et les références du système visuel.
                </div>

                <div class="text-muted small mb-3">
                    Renseigne le logo si disponible pour centraliser les éléments de marque.
                </div>

                <div class="text-muted small">
                    Utilise le statut création tant que la charte n’est pas validée.
                </div>
            </div>
        </div>
    </div>
@endsection