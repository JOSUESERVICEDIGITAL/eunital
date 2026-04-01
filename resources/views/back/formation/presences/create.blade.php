@extends('back.formation.layouts.app')

@section('title', 'Nouvelle présence')
@section('page_title', 'Enregistrer une présence')
@section('page_subtitle', 'Enregistrer la présence d\'un étudiant à un cours')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations de présence
                </h3>
            </div>
            <form action="{{ route('back.formation.presences.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.formation.presences.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.presences.index') }}" class="btn btn-secondary">
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
                    <strong>Statuts de présence :</strong>
                    <ul class="mt-2 mb-0">
                        <li><span class="badge badge-success">Présent</span> - L'étudiant a assisté au cours</li>
                        <li><span class="badge badge-danger">Absent</span> - L'étudiant n'a pas assisté</li>
                        <li><span class="badge badge-warning">Retard</span> - L'étudiant est arrivé en retard</li>
                        <li><span class="badge badge-info">Excusé</span> - Absence justifiée</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h6>Code d'accès :</h6>
                    <p class="text-muted small">
                        Le code d'accès peut être généré automatiquement via le bouton "Générer code"<br>
                        ou saisi manuellement si un code a été fourni.
                    </p>
                </div>
                
                <div class="mt-3">
                    <h6>Calcul automatique :</h6>
                    <p class="text-muted small">
                        La durée de connexion est automatiquement calculée si les heures de début et fin sont renseignées.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-8">Total présences aujourd'hui</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-primary">{{ $presencesAujourdhui ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-8">Présents aujourd'hui</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-success">{{ $presentAujourdhui ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-8">Taux présence global</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-info">{{ round($tauxGlobal ?? 0, 1) }}%</span>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection