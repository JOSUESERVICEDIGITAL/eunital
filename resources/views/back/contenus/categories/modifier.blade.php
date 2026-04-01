@extends('back.layouts.principal')

@section('title', 'Modifier une catégorie')
@section('page_title', 'Modification de catégorie')
@section('page_subtitle', 'Ajuste les informations et la hiérarchie de cette catégorie.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Modifier la catégorie</h4>
                        <p class="text-muted mb-0">Met à jour les informations de <strong>{{ $categorie->nom }}</strong>.</p>
                    </div>

                    @if($categorie->est_active)
                        <span class="badge rounded-pill text-bg-success px-3 py-2">Active</span>
                    @else
                        <span class="badge rounded-pill text-bg-danger px-3 py-2">Inactive</span>
                    @endif
                </div>

                <form method="POST" action="{{ route('back.categories.mettre_a_jour', $categorie) }}">
                    @csrf
                    @method('PUT')

                    @include('back.contenus.categories._formulaire', [
                        'categorie' => $categorie,
                        'categoriesParentes' => $categoriesParentes
                    ])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Mettre à jour
                        </button>

                        <a href="{{ route('back.categories.details', $categorie) }}" class="btn btn-outline-dark rounded-pill px-4">
                            Retour aux détails
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-3">Résumé rapide</h5>
                <div class="vstack gap-3">
                    <div class="resume-box">
                        <span class="text-muted small">Nom actuel</span>
                        <div class="fw-bold">{{ $categorie->nom }}</div>
                    </div>
                    <div class="resume-box">
                        <span class="text-muted small">Slug</span>
                        <div class="fw-bold">{{ $categorie->slug }}</div>
                    </div>
                    <div class="resume-box">
                        <span class="text-muted small">Articles liés</span>
                        <div class="fw-bold">{{ $categorie->articles->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .resume-box{
            padding:16px;
            border-radius:16px;
            border:1px solid #e5e7eb;
            background:#fff;
        }
    </style>
@endsection