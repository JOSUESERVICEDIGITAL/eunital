@extends('back.formation.layouts.app')

@section('title', 'Modifier la salle')
@section('page_title', 'Modifier la salle')
@section('page_subtitle', 'Mettre à jour les paramètres et l’accès de la salle')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Modification de la salle
                </h3>
            </div>

            <form action="{{ route('back.formation.salles.update', $salle) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    @include('back.formation.salles.form')
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i> Mettre à jour
                    </button>

                    <a href="{{ route('back.formation.salles.show', $salle) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @if($salle->image_couverture)
                    <img src="{{ asset('storage/' . $salle->image_couverture) }}" alt="Couverture" class="img-fluid rounded mb-3">
                @endif

                <h5 class="font-weight-bold">{{ $salle->titre }}</h5>
                <p class="text-muted small mb-1">Slug : {{ $salle->slug }}</p>
                <p class="text-muted small mb-0">Type : {{ ucfirst($salle->type_salle) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
