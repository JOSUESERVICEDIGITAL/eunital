@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="modele-hero-card mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="modele-hero-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 text-white">Modèles de documents juridiques</h2>
                        <p class="mb-0 text-white-50">
                            Bibliothèque des modèles standards du hub pour contrats, conventions, attestations et documents réutilisables.
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.chambre-juridique.modeles-documents.toutes') }}"
                       class="btn btn-sm btn-light text-dark fw-semibold rounded-pill px-3">
                        Tous
                    </a>

                    <a href="{{ route('back.chambre-juridique.modeles-documents.actifs') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Actifs
                    </a>

                    <a href="{{ route('back.chambre-juridique.modeles-documents.inactifs') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Inactifs
                    </a>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('back.chambre-juridique.modeles-documents.creer') }}"
                   class="btn btn-warning btn-lg rounded-pill px-4 fw-semibold">
                    Nouveau modèle
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-juridique.modeles-documents._kpis', ['modeles' => $modeles])

    <div class="mt-4">
        @include('back.chambre-juridique.modeles-documents._liste-table', ['modeles' => $modeles])
    </div>

</div>

<style>
    .modele-hero-card{
        background: linear-gradient(135deg, #111827 0%, #1f2937 45%, #374151 100%);
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(15,23,42,.18);
    }
    .modele-hero-icon{
        width:72px;
        height:72px;
        border-radius:22px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(255,255,255,.12);
        color:#fff;
        font-size:28px;
        border:1px solid rgba(255,255,255,.15);
    }
</style>
@endsection
