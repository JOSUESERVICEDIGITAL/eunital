@extends('back.formation.layouts.app')

@section('title', 'Modifier le devoir')
@section('page_title', 'Modification du devoir')
@section('page_subtitle', 'Modifier les informations du devoir : ' . $devoir->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Informations du devoir
                </h3>
            </div>
            <form action="{{ route('back.formation.devoirs.update', $devoir) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.devoirs.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.devoirs.show', $devoir) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir le devoir
                    </a>
                    <a href="{{ route('back.formation.devoirs.index') }}" class="btn btn-secondary">
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
                    <dt class="col-sm-7">Soumissions reçues</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-info">{{ $devoir->soumissions_count }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">À corriger</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-warning">{{ $devoir->nb_soumissions_non_corrigees }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">Note moyenne</dt>
                    <dd class="col-sm-5">
                        @if($devoir->moyenne > 0)
                            <span class="badge badge-success">{{ round($devoir->moyenne, 1) }}/{{ $devoir->note_maximale }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-7">Taux de soumission</dt>
                    <dd class="col-sm-5">
                        @php
                            $totalEtudiants = $devoir->cour->utilisateurs()->count();
                            $taux = $totalEtudiants > 0 ? ($devoir->soumissions_count / $totalEtudiants) * 100 : 0;
                        @endphp
                        <span class="badge badge-{{ $taux >= 80 ? 'success' : ($taux >= 50 ? 'warning' : 'danger') }}">
                            {{ round($taux, 1) }}%
                        </span>
                    </dd>
                    
                    <dt class="col-sm-7">Créé le</dt>
                    <dd class="col-sm-5">{{ $devoir->created_at->format('d/m/Y') }}</dd>
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
                    La suppression d'un devoir entraînera la suppression de toutes les soumissions associées.
                </p>
                <form action="{{ route('back.formation.devoirs.destroy', $devoir) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Supprimer le devoir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection