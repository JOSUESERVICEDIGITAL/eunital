@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h3 class="mb-1">{{ $modele->nom }}</h3>
                    <p class="text-muted mb-2">{{ ucfirst(str_replace('_', ' ', $modele->type_document)) }}</p>

                    <span class="badge text-bg-{{ $modele->actif ? 'success' : 'secondary' }}">
                        {{ $modele->actif ? 'Actif' : 'Inactif' }}
                    </span>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('back.chambre-juridique.modeles-documents.modifier', $modele) }}"
                       class="btn btn-outline-primary rounded-pill px-4">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-dark rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsModele{{ $modele->id }}">
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
                    <h5 class="mb-3">Contenu du modèle</h5>
                    <div class="text-muted" style="white-space: pre-line;">
                        {{ $modele->contenu ?: 'Aucun contenu renseigné.' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Informations</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block">Version</small>
                        <strong>{{ $modele->version ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Type</small>
                        <strong>{{ ucfirst(str_replace('_', ' ', $modele->type_document)) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Auteur</small>
                        <strong>{{ $modele->auteur->name ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Statut</small>
                        <strong>{{ $modele->actif ? 'Actif' : 'Inactif' }}</strong>
                    </div>

                    <div>
                        <small class="text-muted d-block">Créé le</small>
                        <strong>{{ $modele->created_at?->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('back.chambre-juridique.modeles-documents._modales', ['modele' => $modele])
@endsection
