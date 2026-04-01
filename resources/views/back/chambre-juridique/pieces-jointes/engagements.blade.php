@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="piece-hero-card mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="piece-hero-icon">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 text-white">Pièces jointes des engagements</h2>
                        <p class="mb-0 text-white-50">
                            Formulaires, justificatifs et fichiers rattachés aux engagements juridiques et validations hiérarchiques.
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.chambre-juridique.pieces-jointes.toutes') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Toutes
                    </a>

                    <a href="{{ route('back.chambre-juridique.pieces-jointes.contrats') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Contrats
                    </a>

                    <a href="{{ route('back.chambre-juridique.pieces-jointes.engagements') }}"
                       class="btn btn-sm btn-light text-dark fw-semibold rounded-pill px-3">
                        Engagements
                    </a>

                    <a href="{{ route('back.chambre-juridique.pieces-jointes.dossiers') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Dossiers
                    </a>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('back.chambre-juridique.pieces-jointes.creer') }}"
                   class="btn btn-warning btn-lg rounded-pill px-4 fw-semibold">
                    Nouvelle pièce jointe
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-juridique.pieces-jointes._kpis', ['pieces' => $pieces])

    <div class="mt-4">
        @include('back.chambre-juridique.pieces-jointes._liste-table', ['pieces' => $pieces])
    </div>

</div>

<style>
    .piece-hero-card{
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 45%, #334155 100%);
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(15,23,42,.18);
    }
    .piece-hero-icon{
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