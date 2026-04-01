@extends('back.layouts.principal')

@section('title', 'Détails captation')
@section('page_title', 'Fiche détaillée · Captation')
@section('page_subtitle', 'Consulte les informations complètes, le statut et les actions métier d’une captation studio.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Captation</div>
                        <h4 class="mb-0">{{ $captationStudio->titre }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-studio.captations.modifier', $captationStudio) }}"
                           class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsCaptation{{ $captationStudio->id }}">
                            Centre captation
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Événement lié</div>
                            <div class="fw-semibold">{{ $captationStudio->evenement->titre ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Date</div>
                            <div class="fw-semibold">
                                {{ $captationStudio->date ? \Carbon\Carbon::parse($captationStudio->date)->format('d/m/Y') : '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Lieu</div>
                            <div class="fw-semibold">{{ $captationStudio->lieu ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Type</div>
                            <div class="fw-semibold">{{ ucfirst($captationStudio->type) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $captationStudio->statut)) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement captation</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-studio.captations.demarrer', $captationStudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-warning rounded-pill w-100">Démarrer la captation</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-studio.captations.terminer', $captationStudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer terminée</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.captations._modales', ['captationStudio' => $captationStudio])
@endsection