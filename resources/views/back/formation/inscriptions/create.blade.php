@extends('back.formation.layouts.app')

@section('title', 'Nouvelle inscription')
@section('page_title', 'Créer une inscription')
@section('page_subtitle', 'Inscrire un étudiant à un module de formation')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus mr-2"></i>
                    Informations de l'inscription
                </h3>
            </div>
            <form action="{{ route('back.formation.inscriptions.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.formation.inscriptions.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb"></i>
                    <strong>Statuts d'inscription :</strong>
                    <ul class="mt-2 mb-0">
                        <li><span class="badge badge-warning">En attente</span> - Demande en cours de traitement</li>
                        <li><span class="badge badge-success">Validé</span> - Accès au module accordé</li>
                        <li><span class="badge badge-info">Terminé</span> - Module complété</li>
                        <li><span class="badge badge-danger">Abandonné</span> - Module non finalisé</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h6>À savoir :</h6>
                    <ul class="text-muted small">
                        <li>Un étudiant ne peut être inscrit qu'une seule fois par module</li>
                        <li>La progression est calculée automatiquement</li>
                        <li>Les dates de début et fin peuvent être modifiées ultérieurement</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Statistiques
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-8">Total inscriptions</dt>
                    <dd class="col-sm-4"><span class="badge badge-primary">{{ $totalInscriptions ?? 0 }}</span></dd>
                    
                    <dt class="col-sm-8">En attente</dt>
                    <dd class="col-sm-4"><span class="badge badge-warning">{{ $enAttente ?? 0 }}</span></dd>
                    
                    <dt class="col-sm-8">Validées</dt>
                    <dd class="col-sm-4"><span class="badge badge-success">{{ $validees ?? 0 }}</span></dd>
                    
                    <dt class="col-sm-8">Terminées</dt>
                    <dd class="col-sm-4"><span class="badge badge-info">{{ $terminees ?? 0 }}</span></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection