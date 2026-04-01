@extends('back.formation.layouts.app')

@section('title', 'Modifier la soumission')
@section('page_title', 'Modification de la soumission')
@section('page_subtitle', 'Modifier les informations de la soumission')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier la soumission
                </h3>
            </div>
            <form action="{{ route('back.formation.soumissions.update', $soumission) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.soumissions.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.soumissions.show', $soumission) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('back.formation.soumissions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Informations
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-5">Devoir</dt>
                    <dd class="col-sm-7">{{ $soumission->devoir->titre }}</dd>
                    
                    <dt class="col-sm-5">Soumis le</dt>
                    <dd class="col-sm-7">{{ $soumission->soumis_le->format('d/m/Y H:i') }}</dd>
                    
                    @if($soumission->note)
                    <dt class="col-sm-5">Note</dt>
                    <dd class="col-sm-7">
                        <span class="badge badge-{{ $soumission->note >= ($soumission->devoir->note_maximale * 0.6) ? 'success' : 'warning' }}">
                            {{ $soumission->note }}/{{ $soumission->devoir->note_maximale }}
                        </span>
                    </dd>
                    @endif
                </dl>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Zone de danger
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    La suppression d'une soumission est irréversible.
                    @if($soumission->note)
                        La note attribuée sera également supprimée.
                    @endif
                </p>
                <form action="{{ route('back.formation.soumissions.destroy', $soumission) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Supprimer la soumission
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection