@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="mb-1">Nouvelle archive du hub</h3>
        <p class="text-muted mb-0">Ajouter un élément de mémoire institutionnelle, fondation, inauguration ou média historique du hub.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" enctype="multipart/form-data" action="{{ route('back.chambre-juridique.archives-hub.enregistrer') }}">
                @csrf

                @include('back.chambre-juridique.archives-hub._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-lg rounded-pill px-4">
                        Enregistrer l’archive
                    </button>

                    <a href="{{ route('back.chambre-juridique.archives-hub.toutes') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection