@extends('back.layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-4">✏️ Modifier commande</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('back.chambre-studio.commandes.mettre_a_jour', $commandeStudio) }}">
                @csrf
                @method('PUT')

                @include('back.chambre-studio.commandes._form')

                <button type="submit" class="btn btn-primary mt-3">
                    Mettre à jour
                </button>
            </form>
        </div>
    </div>

</div>
@endsection