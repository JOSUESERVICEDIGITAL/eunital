@extends('back.layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-4">➕ Nouvel événement studio</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('back.chambre-studio.evenements.enregistrer') }}">
                @csrf

                @include('back.chambre-studio.evenements._form')

                <button type="submit" class="btn btn-dark mt-3">
                    Enregistrer
                </button>
            </form>
        </div>
    </div>

</div>
@endsection