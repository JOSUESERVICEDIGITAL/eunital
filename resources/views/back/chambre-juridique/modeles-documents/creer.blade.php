@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="mb-1">Nouveau modèle documentaire</h3>
        <p class="text-muted mb-0">Créer un modèle réutilisable pour les contrats, conventions, attestations et autres documents juridiques.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('back.chambre-juridique.modeles-documents.enregistrer') }}">
                @csrf

                @include('back.chambre-juridique.modeles-documents._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-lg rounded-pill px-4">
                        Enregistrer le modèle
                    </button>

                    <a href="{{ route('back.chambre-juridique.modeles-documents.toutes') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
