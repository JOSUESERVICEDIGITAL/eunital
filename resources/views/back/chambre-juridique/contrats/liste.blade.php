@extends('back.layouts.principal')

@section('content')
@php
    $routeName = request()->route()->getName();

    $pageTitle = match($routeName) {
        'back.chambre-juridique.contrats.brouillons' => 'Contrats brouillons',
        'back.chambre-juridique.contrats.valides' => 'Contrats validés',
        'back.chambre-juridique.contrats.signes' => 'Contrats signés',
        'back.chambre-juridique.contrats.archives' => 'Contrats archivés',
        default => 'Contrats juridiques',
    };

    $pageSubtitle = match($routeName) {
        'back.chambre-juridique.contrats.brouillons' => 'Préparation des contrats avant validation officielle.',
        'back.chambre-juridique.contrats.valides' => 'Contrats approuvés et prêts pour signature ou exécution.',
        'back.chambre-juridique.contrats.signes' => 'Contrats signés et juridiquement activés.',
        'back.chambre-juridique.contrats.archives' => 'Historique des contrats clôturés ou classés.',
        default => 'Gestion centralisée des contrats du hub : RH, clients, partenariats, prestations et conventions.',
    };
@endphp

<div class="container-fluid">

    <div class="juridique-hero-card mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="juridique-hero-icon">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 text-white">{{ $pageTitle }}</h2>
                        <p class="mb-0 text-white-50">
                            {{ $pageSubtitle }}
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.chambre-juridique.contrats.toutes') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-juridique.contrats.toutes') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Tous
                    </a>

                    <a href="{{ route('back.chambre-juridique.contrats.brouillons') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-juridique.contrats.brouillons') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Brouillons
                    </a>

                    <a href="{{ route('back.chambre-juridique.contrats.valides') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-juridique.contrats.valides') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Validés
                    </a>

                    <a href="{{ route('back.chambre-juridique.contrats.signes') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-juridique.contrats.signes') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Signés
                    </a>

                    <a href="{{ route('back.chambre-juridique.contrats.archives') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-juridique.contrats.archives') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Archivés
                    </a>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('back.chambre-juridique.contrats.creer') }}"
                   class="btn btn-warning btn-lg rounded-pill px-4 fw-semibold">
                    Nouveau contrat
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-juridique.contrats._kpis', ['contrats' => $contrats])

    <div class="mt-4">
        @include('back.chambre-juridique.contrats._liste-table', ['contrats' => $contrats])
    </div>

</div>

<style>
    .juridique-hero-card{
        background: linear-gradient(135deg, #111827 0%, #1f2937 45%, #475569 100%);
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(15,23,42,.18);
    }
    .juridique-hero-icon{
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
