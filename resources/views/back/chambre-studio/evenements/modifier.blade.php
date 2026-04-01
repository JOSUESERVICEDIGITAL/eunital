@extends('back.layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-4">✏️ Modifier événement</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('back.chambre-studio.evenements.mettre_a_jour', $evenementStudio) }}">
                @csrf
                @method('PUT')

                @include('back.chambre-studio.evenements._form')

                <button type="submit" class="btn btn-primary mt-3">
                    Mettre à jour
                </button>
            </form>
        </div>
    </div>

</div>
@endsection