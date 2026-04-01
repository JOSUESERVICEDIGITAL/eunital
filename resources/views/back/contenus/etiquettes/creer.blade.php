@extends('back.layouts.principal')

@section('title', 'Créer une étiquette')
@section('page_title', 'Nouvelle étiquette')
@section('page_subtitle', 'Création d’un nouveau mot-clé pour enrichir et affiner la classification des contenus.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Formulaire de création</h4>
                        <p class="text-muted mb-0">Ajoute une nouvelle étiquette au système éditorial.</p>
                    </div>
                    <span class="badge rounded-pill text-bg-info px-3 py-2">Nouvelle étiquette</span>
                </div>

                <form method="POST" action="{{ route('back.etiquettes.enregistrer') }}">
                    @csrf

                    @include('back.contenus.etiquettes._formulaire', [
                        'etiquette' => null
                    ])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                        </button>

                        <a href="{{ route('back.etiquettes.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-3">Bonnes pratiques</h5>
                <div class="vstack gap-3">
                    <div class="advice-box">
                        <strong>Nom court</strong>
                        <p class="mb-0 text-muted small">Choisis un mot-clé simple, mémorisable et pertinent.</p>
                    </div>
                    <div class="advice-box">
                        <strong>Pas de doublon</strong>
                        <p class="mb-0 text-muted small">Évite les synonymes inutiles qui compliquent la classification.</p>
                    </div>
                    <div class="advice-box">
                        <strong>Vision éditoriale</strong>
                        <p class="mb-0 text-muted small">Utilise des étiquettes cohérentes avec tes catégories et tes thèmes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .advice-box{padding:16px;border:1px solid #e5e7eb;border-radius:16px;background:#f8fafc}
    </style>
@endsection