@extends('back.layouts.principal')

@section('title', 'Détails catégorie')
@section('page_title', 'Détails de la catégorie')
@section('page_subtitle', 'Vue détaillée de la catégorie, de sa hiérarchie et de son activité.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $categorie->nom }}</h3>
                        <p class="text-muted mb-0">{{ $categorie->description ?: 'Aucune description disponible.' }}</p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.categories.modifier', $categorie) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>

                        @if($categorie->est_active)
                            <form method="POST" action="{{ route('back.categories.desactiver', $categorie) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                                    Désactiver
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('back.categories.activer', $categorie) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success rounded-pill px-4">
                                    Activer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Slug</span>
                            <div class="fw-bold">{{ $categorie->slug }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Statut</span>
                            <div class="fw-bold">
                                @if($categorie->est_active)
                                    <span class="badge rounded-pill text-bg-success">Active</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Inactive</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Catégorie parente</span>
                            <div class="fw-bold">{{ $categorie->categorieParente->nom ?? 'Aucune' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Sous-catégories</span>
                            <div class="fw-bold">{{ $categorie->sousCategories->count() }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-tile">
                            <span class="text-muted small">Articles liés</span>
                            <div class="fw-bold mt-1">{{ $categorie->articles->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <h5 class="fw-bold mb-3">Actions rapides</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('back.categories.toutes') }}" class="btn btn-outline-dark rounded-pill">Toutes les catégories</a>
                    <a href="{{ route('back.categories.actives') }}" class="btn btn-outline-success rounded-pill">Catégories actives</a>
                    <a href="{{ route('back.categories.inactives') }}" class="btn btn-outline-secondary rounded-pill">Catégories inactives</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{
            padding:18px;
            border-radius:18px;
            border:1px solid #e5e7eb;
            background:#f8fafc;
        }
    </style>
@endsection