@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="mb-1">Nouveau contrat juridique</h3>
        <p class="text-muted mb-0">Créer un contrat professionnel pour le hub, un client, un employé ou un partenaire.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" enctype="multipart/form-data" action="{{ route('back.chambre-juridique.contrats.enregistrer') }}">
                @csrf

                @include('back.chambre-juridique.contrats._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-lg rounded-pill px-4">
                        Enregistrer le contrat
                    </button>

                    <a href="{{ route('back.chambre-juridique.contrats.toutes') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
