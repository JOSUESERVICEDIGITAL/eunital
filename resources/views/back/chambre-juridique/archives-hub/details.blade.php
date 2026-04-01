@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h3 class="mb-1">{{ $archive->titre }}</h3>
                    <p class="text-muted mb-2">{{ ucfirst(str_replace('_', ' ', $archive->categorie)) }}</p>

                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge text-bg-light border">
                            {{ ucfirst($archive->type_fichier) }}
                        </span>

                        <span class="badge text-bg-{{ $archive->visible ? 'success' : 'secondary' }}">
                            {{ $archive->visible ? 'Visible' : 'Masquée' }}
                        </span>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('back.chambre-juridique.archives-hub.modifier', $archive) }}"
                       class="btn btn-outline-primary rounded-pill px-4">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-dark rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsArchive{{ $archive->id }}">
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
                    <h5 class="mb-3">Description de l’archive</h5>
                    <div class="text-muted" style="white-space: pre-line;">
                        {{ $archive->description ?: 'Aucune description renseignée.' }}
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
                        <strong>{{ ucfirst(str_replace('_', ' ', $archive->categorie)) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Type de fichier</small>
                        <strong>{{ ucfirst($archive->type_fichier) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Date archive</small>
                        <strong>{{ $archive->date_archive ? \Carbon\Carbon::parse($archive->date_archive)->format('d/m/Y') : '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Auteur</small>
                        <strong>{{ $archive->auteur->name ?? '—' }}</strong>
                    </div>

                    @if($archive->fichier)
                        <a href="{{ asset('storage/' . $archive->fichier) }}"
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

@include('back.chambre-juridique.archives-hub._modales', ['archive' => $archive])
@endsection