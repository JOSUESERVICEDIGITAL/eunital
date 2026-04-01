@extends('back.layouts.principal')

@section('title', 'Modifier client studio')
@section('page_title', 'Modifier un client studio')
@section('page_subtitle', 'Mets à jour les informations d’un artiste, d’une entreprise ou d’un particulier.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.clients.update', $clientStudio) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-studio.clients._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-pen me-1"></i> Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-studio.clients.details', $clientStudio) }}" class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Client actuel</h5>

                <div class="mb-3">
                    <div class="mini-label">Nom</div>
                    <div class="fw-semibold">{{ $clientStudio->nom }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Type</div>
                    <div class="fw-semibold">{{ ucfirst($clientStudio->type ?? 'non défini') }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Téléphone</div>
                    <div class="fw-semibold">{{ $clientStudio->telephone ?: '—' }}</div>
                </div>

                <div>
                    <div class="mini-label">Email</div>
                    <div class="fw-semibold">{{ $clientStudio->email ?: '—' }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
