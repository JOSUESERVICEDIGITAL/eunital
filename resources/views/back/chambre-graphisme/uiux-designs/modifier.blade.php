@extends('back.layouts.principal')

@section('title', 'Modifier design UI/UX')
@section('page_title', 'Modifier un design UI/UX')
@section('page_subtitle', 'Mets à jour le type, le projet, le fichier et l’état d’avancement du design.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.uiux.update', $design) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-graphisme.uiux-designs._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-graphisme.uiux.details', $design) }}" class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Design actuel</h5>

                <div class="mb-3">
                    <div class="mini-label">Titre</div>
                    <div class="fw-semibold">{{ $design->titre }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Type</div>
                    <div class="fw-semibold">{{ ucfirst($design->type) }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Projet</div>
                    <div class="fw-semibold">{{ $design->projet->titre ?? '—' }}</div>
                </div>

                <div>
                    <div class="mini-label">Statut</div>
                    <div class="fw-semibold">{{ ucfirst($design->statut) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection