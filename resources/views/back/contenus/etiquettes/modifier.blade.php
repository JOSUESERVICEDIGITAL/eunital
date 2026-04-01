@extends('back.layouts.principal')

@section('title', 'Modifier une étiquette')
@section('page_title', 'Modification d’étiquette')
@section('page_subtitle', 'Mets à jour le mot-clé et son identité éditoriale.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Modifier l’étiquette</h4>
                        <p class="text-muted mb-0">Ajuste les informations de <strong>{{ $etiquette->nom }}</strong>.</p>
                    </div>

                    <span class="badge rounded-pill text-bg-warning px-3 py-2">Édition</span>
                </div>

                <form method="POST" action="{{ route('back.etiquettes.mettre_a_jour', $etiquette) }}">
                    @csrf
                    @method('PUT')

                    @include('back.contenus.etiquettes._formulaire', [
                        'etiquette' => $etiquette
                    ])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Mettre à jour
                        </button>

                        <a href="{{ route('back.etiquettes.details', $etiquette) }}" class="btn btn-outline-dark rounded-pill px-4">
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
                        <div class="fw-bold">{{ $etiquette->nom }}</div>
                    </div>
                    <div class="resume-box">
                        <span class="text-muted small">Slug</span>
                        <div class="fw-bold">{{ $etiquette->slug }}</div>
                    </div>
                    <div class="resume-box">
                        <span class="text-muted small">Articles liés</span>
                        <div class="fw-bold">{{ $etiquette->articles->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .resume-box{padding:16px;border-radius:16px;border:1px solid #e5e7eb;background:#fff}
    </style>
@endsection