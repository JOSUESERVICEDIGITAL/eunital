@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="mb-1">Modifier le modèle</h3>
        <p class="text-muted mb-0">Mettre à jour le contenu, le statut ou la version du modèle documentaire.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('back.chambre-juridique.modeles-documents.update', $modele) }}">
                @csrf
                @method('PUT')

                @include('back.chambre-juridique.modeles-documents._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                        Mettre à jour
                    </button>

                    <a href="{{ route('back.chambre-juridique.modeles-documents.details', $modele) }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
