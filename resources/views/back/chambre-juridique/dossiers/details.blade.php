@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h3 class="mb-1">{{ $dossier->titre }}</h3>
                    <p class="text-muted mb-2">{{ ucfirst(str_replace('_', ' ', $dossier->type_dossier)) }}</p>

                    @php
                        $statusBadge = match($dossier->statut) {
                            'ouvert' => 'secondary',
                            'en_cours' => 'warning',
                            'ferme' => 'success',
                            'archive' => 'dark',
                            default => 'secondary'
                        };

                        $priorityBadge = match($dossier->priorite) {
                            'faible' => 'secondary',
                            'normale' => 'info',
                            'urgente' => 'danger',
                            default => 'secondary'
                        };
                    @endphp

                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge text-bg-{{ $statusBadge }}">
                            {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                        </span>

                        <span class="badge text-bg-{{ $priorityBadge }}">
                            {{ ucfirst($dossier->priorite) }}
                        </span>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('back.chambre-juridique.dossiers.modifier', $dossier) }}"
                       class="btn btn-outline-primary rounded-pill px-4">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-dark rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsDossier{{ $dossier->id }}">
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
                        {{ $dossier->description ?: 'Aucune description renseignée.' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Informations</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block">Client</small>
                        <strong>{{ $dossier->client->nom ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Responsable</small>
                        <strong>{{ $dossier->responsable->name ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Type</small>
                        <strong>{{ ucfirst(str_replace('_', ' ', $dossier->type_dossier)) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Priorité</small>
                        <strong>{{ ucfirst($dossier->priorite) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Statut</small>
                        <strong>{{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}</strong>
                    </div>

                    <div>
                        <small class="text-muted d-block">Créé le</small>
                        <strong>{{ $dossier->created_at?->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('back.chambre-juridique.dossiers._modales', ['dossier' => $dossier])
@endsection
