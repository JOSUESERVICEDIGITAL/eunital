@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="document-hero-card mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="document-hero-icon">
                        <i class="fa-solid fa-box-archive"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 text-white">Documents archivés</h2>
                        <p class="mb-0 text-white-50">
                            Documents anciens, remplacés ou conservés uniquement à titre de référence juridique et historique.
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.chambre-juridique.documents.toutes') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Tous
                    </a>

                    <a href="{{ route('back.chambre-juridique.documents.actifs') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Actifs
                    </a>

                    <a href="{{ route('back.chambre-juridique.documents.archives') }}"
                       class="btn btn-sm btn-light text-dark fw-semibold rounded-pill px-3">
                        Archivés
                    </a>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('back.chambre-juridique.documents.creer') }}"
                   class="btn btn-warning btn-lg rounded-pill px-4 fw-semibold">
                    Nouveau document
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-juridique.documents._kpis', ['documents' => $documents])

    <div class="mt-4">
        @include('back.chambre-juridique.documents._liste-table', ['documents' => $documents])
    </div>

</div>

<style>
    .document-hero-card{
        background: linear-gradient(135deg, #111827 0%, #1f2937 45%, #374151 100%);
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(15,23,42,.18);
    }
    .document-hero-icon{
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
