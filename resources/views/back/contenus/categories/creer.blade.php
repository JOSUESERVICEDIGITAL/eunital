@extends('back.layouts.principal')

@section('title', 'Créer une catégorie')
@section('page_title', 'Nouvelle catégorie')
@section('page_subtitle', 'Création d’une nouvelle catégorie dans la chambre des contenus.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Formulaire de création</h4>
                        <p class="text-muted mb-0">Renseigne les informations de la nouvelle catégorie.</p>
                    </div>
                    <span class="badge rounded-pill text-bg-info px-3 py-2">Nouvelle entrée</span>
                </div>

                <form method="POST" action="{{ route('back.categories.enregistrer') }}">
                    @csrf
                    @include('back.contenus.categories._formulaire', [
                        'categorie' => null,
                        'categoriesParentes' => $categoriesParentes
                    ])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                        </button>

                        <a href="{{ route('back.categories.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-3">Conseils de structuration</h5>
                <div class="vstack gap-3">
                    <div class="advice-box">
                        <strong>Nom clair</strong>
                        <p class="mb-0 text-muted small">Choisis un nom court et compréhensible.</p>
                    </div>
                    <div class="advice-box">
                        <strong>Hiérarchie logique</strong>
                        <p class="mb-0 text-muted small">Utilise une catégorie parente seulement si nécessaire.</p>
                    </div>
                    <div class="advice-box">
                        <strong>Activation immédiate</strong>
                        <p class="mb-0 text-muted small">Laisse active la catégorie si elle doit être utilisée tout de suite.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .advice-box{
            padding:16px;
            border:1px solid #e5e7eb;
            border-radius:16px;
            background:#f8fafc;
        }
    </style>
@endsection