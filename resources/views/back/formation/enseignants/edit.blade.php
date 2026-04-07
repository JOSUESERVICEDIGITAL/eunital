@extends('back.formation.layouts.app')

@section('title', 'Modifier l\'enseignant')
@section('page_title', 'Modification')
@section('page_subtitle', $enseignant->user->name)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier l'enseignant
                </h3>
            </div>
            <form action="{{ route('back.formation.enseignants.update', $enseignant) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.enseignants.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.enseignants.show', $enseignant) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('back.formation.enseignants.index') }}" class="btn btn-secondary">
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
                    Statistiques
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-7">Cours assignés</dt>
                    <dd class="col-sm-5">{{ $enseignant->cours->count() }}</dd>
                    
                    <dt class="col-sm-7">Date d'ajout</dt>
                    <dd class="col-sm-5">{{ $enseignant->created_at->format('d/m/Y') }}</dd>
                    
                    <dt class="col-sm-7">Dernière modification</dt>
                    <dd class="col-sm-5">{{ $enseignant->updated_at->format('d/m/Y') }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection