@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="mb-1">Nouvel engagement juridique</h3>
        <p class="text-muted mb-0">Créer un dossier d’engagement pour RH, stage, prestation, formation ou autre besoin du hub.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" enctype="multipart/form-data" action="{{ route('back.chambre-juridique.engagements.enregistrer') }}">
                @csrf

                @include('back.chambre-juridique.engagements._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-lg rounded-pill px-4">
                        Enregistrer l’engagement
                    </button>

                    <a href="{{ route('back.chambre-juridique.engagements.toutes') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
