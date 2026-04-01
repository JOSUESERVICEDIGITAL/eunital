@extends('back.layouts.principal')

@section('title', 'Modifier captation')
@section('page_title', 'Modifier une captation studio')
@section('page_subtitle', 'Mets à jour les informations, le lieu, la date et le statut d’une captation.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.captations.update', $captationStudio) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-studio.captations._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-pen me-1"></i> Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-studio.captations.details', $captationStudio) }}" class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Captation actuelle</h5>

                <div class="mb-3">
                    <div class="mini-label">Titre</div>
                    <div class="fw-semibold">{{ $captationStudio->titre }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Événement</div>
                    <div class="fw-semibold">{{ $captationStudio->evenement->titre ?? '—' }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Date</div>
                    <div class="fw-semibold">
                        {{ $captationStudio->date ? \Carbon\Carbon::parse($captationStudio->date)->format('d/m/Y') : '—' }}
                    </div>
                </div>

                <div>
                    <div class="mini-label">Statut</div>
                    <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $captationStudio->statut)) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection