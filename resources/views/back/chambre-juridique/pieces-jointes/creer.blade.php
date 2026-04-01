@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="mb-1">Nouvelle pièce jointe juridique</h3>
        <p class="text-muted mb-0">Ajouter un justificatif, une preuve, une annexe ou un document lié à un dossier juridique du hub.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" enctype="multipart/form-data" action="{{ route('back.chambre-juridique.pieces-jointes.enregistrer') }}">
                @csrf

                @include('back.chambre-juridique.pieces-jointes._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-lg rounded-pill px-4">
                        Enregistrer la pièce
                    </button>

                    <a href="{{ route('back.chambre-juridique.pieces-jointes.toutes') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection