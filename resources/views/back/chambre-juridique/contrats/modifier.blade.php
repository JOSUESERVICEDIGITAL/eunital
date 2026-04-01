@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="mb-1">Modifier le contrat</h3>
        <p class="text-muted mb-0">Mettre à jour les informations juridiques, le contenu et le statut du contrat.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form method="POST" enctype="multipart/form-data" action="{{ route('back.chambre-juridique.contrats.update', $contrat) }}">
                @csrf
                @method('PUT')

                @include('back.chambre-juridique.contrats._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                        Mettre à jour
                    </button>

                    <a href="{{ route('back.chambre-juridique.contrats.details', $contrat) }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
