@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h3 class="mb-1">{{ $document->titre }}</h3>
                    <p class="text-muted mb-2">{{ ucfirst(str_replace('_', ' ', $document->categorie)) }}</p>

                    @php
                        $badge = match($document->statut) {
                            'brouillon' => 'secondary',
                            'actif' => 'success',
                            'archive' => 'dark',
                            default => 'secondary'
                        };
                    @endphp

                    <span class="badge text-bg-{{ $badge }}">
                        {{ ucfirst($document->statut) }}
                    </span>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('back.chambre-juridique.documents.modifier', $document) }}"
                       class="btn btn-outline-primary rounded-pill px-4">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-dark rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsDocument{{ $document->id }}">
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
                    <h5 class="mb-3">Contenu du document</h5>
                    <div class="text-muted" style="white-space: pre-line;">
                        {{ $document->contenu ?: 'Aucun contenu renseigné.' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Informations</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block">Catégorie</small>
                        <strong>{{ ucfirst(str_replace('_', ' ', $document->categorie)) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Auteur</small>
                        <strong>{{ $document->auteur->name ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Statut</small>
                        <strong>{{ ucfirst($document->statut) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Créé le</small>
                        <strong>{{ $document->created_at?->format('d/m/Y H:i') }}</strong>
                    </div>

                    @if($document->fichier)
                        <a href="{{ asset('storage/' . $document->fichier) }}"
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

@include('back.chambre-juridique.documents._modales', ['document' => $document])
@endsection
