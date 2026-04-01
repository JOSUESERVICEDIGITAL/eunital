@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="archive-hero-card mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="archive-hero-icon">
                        <i class="fa-solid fa-ribbon"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 text-white">Archives des inaugurations</h2>
                        <p class="mb-0 text-white-50">
                            Éléments historiques relatifs aux lancements, cérémonies et grandes ouvertures du hub.
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.chambre-juridique.archives-hub.toutes') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Toutes
                    </a>

                    <a href="{{ route('back.chambre-juridique.archives-hub.fondations') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Fondations
                    </a>

                    <a href="{{ route('back.chambre-juridique.archives-hub.inaugurations') }}"
                       class="btn btn-sm btn-light text-dark fw-semibold rounded-pill px-3">
                        Inaugurations
                    </a>

                    <a href="{{ route('back.chambre-juridique.archives-hub.medias') }}"
                       class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Médias
                    </a>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('back.chambre-juridique.archives-hub.creer') }}"
                   class="btn btn-warning btn-lg rounded-pill px-4 fw-semibold">
                    Nouvelle archive
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-juridique.archives-hub._kpis', ['archives' => $archives])

    <div class="mt-4">
        @include('back.chambre-juridique.archives-hub._liste-table', ['archives' => $archives])
    </div>

</div>

<style>
    .archive-hero-card{
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 45%, #334155 100%);
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(15,23,42,.18);
    }
    .archive-hero-icon{
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