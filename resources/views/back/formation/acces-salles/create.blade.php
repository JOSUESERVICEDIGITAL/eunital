@extends('back.formation.layouts.app')

@section('title', 'Générer un code d\'accès')
@section('page_title', 'Générer un code d\'accès')
@section('page_subtitle', 'Créer un code temporaire pour l\'accès à une salle de cours')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nouveau code d'accès
                </h3>
            </div>
            <form action="{{ route('back.formation.acces-salles.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.formation.acces-salles.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Générer
                    </button>
                    <a href="{{ route('back.formation.acces-salles.index') }}" class="btn btn-secondary">
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
                    <strong>Fonctionnement :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Le code est généré automatiquement si laissé vide</li>
                        <li>Le code expire après la durée définie</li>
                        <li>Les codes expirés ne sont plus valables</li>
                        <li>Un code actif peut être désactivé manuellement</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h6>Durées d'expiration courantes :</h6>
                    <ul class="text-muted small">
                        <li>1 heure - Pour une session de cours standard</li>
                        <li>2 heures - Pour un cours avec pause</li>
                        <li>4 heures - Pour un atelier ou formation</li>
                        <li>1 jour - Pour un accès prolongé</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <h6>Limite d'utilisateurs :</h6>
                    <p class="text-muted small">
                        Laissez vide pour une limite illimitée.<br>
                        Utile pour contrôler le nombre d'accès simultanés.
                    </p>
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
                    <dt class="col-sm-8">Codes actifs</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-success">{{ $codesActifs ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-8">Codes expirés</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-danger">{{ $codesExpires ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-8">Connexions actives</dt>
                    <dd class="col-sm-4">
                        <span class="badge badge-info">{{ $connexionsActives ?? 0 }}</span>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection