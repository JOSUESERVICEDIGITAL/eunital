@extends('back.formation.layouts.app')

@section('title', 'Modifier présence')
@section('page_title', 'Modification de la présence')
@section('page_subtitle', 'Modifier les informations de présence de ' . $presence->inscription->user->name)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Informations de présence
                </h3>
            </div>
            <form action="{{ route('back.formation.presences.update', $presence) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.presences.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.presences.show', $presence) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('back.formation.presences.index') }}" class="btn btn-secondary">
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
                    Statistiques de l'étudiant
                </h3>
            </div>
            <div class="card-body">
                @php
                    $inscription = $presence->inscription;
                    $totalPresences = $inscription->presences()->count();
                    $presencesPresent = $inscription->presences()->where('present', true)->count();
                    $tauxPresence = $totalPresences > 0 ? ($presencesPresent / $totalPresences) * 100 : 0;
                @endphp
                
                <dl class="row">
                    <dt class="col-sm-8">Taux de présence global</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-{{ $tauxPresence >= 75 ? 'success' : ($tauxPresence >= 50 ? 'warning' : 'danger') }}">
                            {{ round($tauxPresence, 1) }}%
                        </span>
                    </dd>
                    
                    <dt class="col-sm-8">Total présences</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-info">{{ $totalPresences }}</span>
                    </dd>
                    
                    <dt class="col-sm-8">Présences justifiées</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-primary">{{ $inscription->presences()->where('statut', 'excusé')->count() }}</span>
                    </dd>
                    
                    <dt class="col-sm-8">Retards</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-warning">{{ $inscription->presences()->where('statut', 'retard')->count() }}</span>
                    </dd>
                </dl>
                
                <div class="progress-group mt-3">
                    <span class="progress-text">Taux de présence</span>
                    <span class="progress-number"><b>{{ round($tauxPresence, 1) }}%</b></span>
                    <div class="progress">
                        <div class="progress-bar bg-{{ $tauxPresence >= 75 ? 'success' : ($tauxPresence >= 50 ? 'warning' : 'danger') }}" 
                             style="width: {{ $tauxPresence }}%">
                        </div>
                    </div>
                </div>
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
                    La suppression de cette présence est irréversible.
                    Les statistiques de l'étudiant seront recalculées.
                </p>
                <form action="{{ route('back.formation.presences.destroy', $presence) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Supprimer cette présence
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection