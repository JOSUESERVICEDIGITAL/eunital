@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h3 class="mb-1">{{ $piece->titre }}</h3>
                    <p class="text-muted mb-2">{{ ucfirst(str_replace('_', ' ', $piece->type_piece)) }}</p>

                    <div class="d-flex flex-wrap gap-2">
                        @if($piece->contrat)
                            <span class="badge text-bg-primary">Contrat</span>
                        @elseif($piece->engagement)
                            <span class="badge text-bg-info">Engagement</span>
                        @elseif($piece->dossier)
                            <span class="badge text-bg-warning">Dossier</span>
                        @elseif($piece->archive)
                            <span class="badge text-bg-secondary">Archive</span>
                        @else
                            <span class="badge text-bg-light border text-dark">Non liée</span>
                        @endif
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('back.chambre-juridique.pieces-jointes.modifier', $piece) }}"
                       class="btn btn-outline-primary rounded-pill px-4">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-dark rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsPiece{{ $piece->id }}">
                        Actions
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Liaisons juridiques</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block">Contrat</small>
                        <strong>{{ $piece->contrat?->titre ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Engagement</small>
                        <strong>{{ $piece->engagement?->nom_complet ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Dossier</small>
                        <strong>{{ $piece->dossier?->titre ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Archive</small>
                        <strong>{{ $piece->archive?->titre ?? '—' }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Informations</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block">Type</small>
                        <strong>{{ ucfirst(str_replace('_', ' ', $piece->type_piece)) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Auteur</small>
                        <strong>{{ $piece->auteur->name ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Créée le</small>
                        <strong>{{ $piece->created_at?->format('d/m/Y H:i') }}</strong>
                    </div>

                    @if($piece->fichier)
                        <a href="{{ asset('storage/' . $piece->fichier) }}"
                           target="_blank"
                           class="btn btn-outline-dark rounded-pill w-100">
                            Télécharger le fichier
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@include('back.chambre-juridique.pieces-jointes._modales', ['piece' => $piece])
@endsection