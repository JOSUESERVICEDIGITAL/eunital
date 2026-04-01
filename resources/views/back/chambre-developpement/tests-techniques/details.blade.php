@extends('back.layouts.principal')

@section('title', 'Détails test technique')
@section('page_title', 'Chambre développement · Détails test technique')
@section('page_subtitle', 'Vue détaillée du scénario de test, de son exécution, de son résultat et de son environnement.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $testTechnique->titre }}</h3>
                <p class="text-muted mb-0">{{ $testTechnique->description ?: 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-developpement.tests-techniques.modifier', $testTechnique) }}"
                   class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>

                <button type="button"
                    class="btn btn-outline-danger rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuppressionTestTechnique{{ $testTechnique->id }}">
                    Supprimer
                </button>
            </div>
        </div>

        @include('back.chambre-developpement.tests-techniques._modales', ['testTechnique' => $testTechnique])

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Type</span>
                    <div class="fw-bold mt-2">{{ ucfirst($testTechnique->type_test) }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Résultat</span>
                    <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($testTechnique->resultat)) }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($testTechnique->statut)) }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Environnement</span>
                    <div class="fw-bold mt-2">{{ $testTechnique->environnement_test ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Auteur</span>
                    <div class="fw-bold mt-2">{{ $testTechnique->auteur->name ?? '—' }}</div>
                </div>
            </div>
        </div>

        <div class="detail-zone mt-4">
            <strong>Description détaillée</strong><br>
            {{ $testTechnique->description ?: 'Non renseignée.' }}
        </div>
    </div>

    <style>
        .info-tile,.detail-zone{
            padding:18px;
            border-radius:18px;
            border:1px solid #e5e7eb;
            background:#f8fafc;
            white-space:pre-line
        }
    </style>
@endsection
