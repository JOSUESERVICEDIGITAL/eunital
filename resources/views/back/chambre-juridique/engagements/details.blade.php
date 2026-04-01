@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h3 class="mb-1">{{ $engagement->nom_complet }}</h3>
                    <p class="text-muted mb-2">{{ ucfirst($engagement->type_engagement) }}</p>

                    @php
                        $badge = match($engagement->statut) {
                            'en_attente' => 'secondary',
                            'en_etude' => 'warning',
                            'valide' => 'success',
                            'rejete' => 'danger',
                            'archive' => 'dark',
                            default => 'secondary'
                        };
                    @endphp

                    <span class="badge text-bg-{{ $badge }}">
                        {{ ucfirst(str_replace('_',' ', $engagement->statut)) }}
                    </span>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('back.chambre-juridique.engagements.modifier', $engagement) }}"
                       class="btn btn-outline-primary rounded-pill px-4">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-dark rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsEngagement{{ $engagement->id }}">
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
                    <h5 class="mb-3">Description du dossier</h5>
                    <div class="text-muted" style="white-space: pre-line;">
                        {{ $engagement->description ?: 'Aucune description renseignée.' }}
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Observations</h5>
                    <div class="text-muted" style="white-space: pre-line;">
                        {{ $engagement->observation ?: 'Aucune observation.' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Informations</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block">Email</small>
                        <strong>{{ $engagement->email ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Téléphone</small>
                        <strong>{{ $engagement->telephone ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Service concerné</small>
                        <strong>{{ $engagement->service_concerne ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Chambre source</small>
                        <strong>{{ $engagement->chambre_source ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Client / utilisateur</small>
                        <strong>{{ $engagement->client->nom ?? $engagement->user->name ?? '—' }}</strong>
                    </div>

                    @if($engagement->date_validation)
                        <div class="mb-3">
                            <small class="text-muted d-block">Date validation</small>
                            <strong>{{ \Carbon\Carbon::parse($engagement->date_validation)->format('d/m/Y H:i') }}</strong>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Téléchargements</h5>

                    <div class="d-grid gap-2">
                        @if($engagement->fichier_formulaire)
                            <a href="{{ asset('storage/' . $engagement->fichier_formulaire) }}"
                               target="_blank"
                               class="btn btn-outline-dark rounded-pill">
                                Télécharger le formulaire
                            </a>
                        @endif

                        @if($engagement->fichier_contrat)
                            <a href="{{ asset('storage/' . $engagement->fichier_contrat) }}"
                               target="_blank"
                               class="btn btn-outline-primary rounded-pill">
                                Télécharger le contrat
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('back.chambre-juridique.engagements._modales', ['engagement' => $engagement])
@endsection
