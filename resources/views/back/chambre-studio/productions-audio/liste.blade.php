@extends('back.layouts.principal')

@section('title', 'Productions audio')
@section('page_title', 'Chambre Studio · Productions audio')
@section('page_subtitle', 'Enregistrement, mixage, mastering, livraison et suivi des sessions audio du hub.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.productions-audio._kpis', ['audios' => $audios])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline audio</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Dashboard studio
                </a>

                <a href="{{ route('back.chambre-studio.productions-audio.creer') }}"
                    class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouvelle session
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-studio.productions-audio.toutes') }}"
                class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-audio.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Toutes
            </a>

            <a href="{{ route('back.chambre-studio.productions-audio.enregistrement') }}"
                class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-audio.enregistrement') ? 'btn-primary' : 'btn-outline-primary' }}">
                Enregistrement
            </a>

            <a href="{{ route('back.chambre-studio.productions-audio.mixage') }}"
                class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-audio.mixage') ? 'btn-warning' : 'btn-outline-warning' }}">
                Mixage
            </a>

            <a href="{{ route('back.chambre-studio.productions-audio.mastering') }}"
                class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-audio.mastering') ? 'btn-info' : 'btn-outline-info' }}">
                Mastering
            </a>

            <a href="{{ route('back.chambre-studio.productions-audio.livrees') }}"
                class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-audio.livrees') ? 'btn-success' : 'btn-outline-success' }}">
                Livrées
            </a>
        </div>
    </div>

    @include('back.chambre-studio.productions-audio._liste-table', ['audios' => $audios])
@endsection