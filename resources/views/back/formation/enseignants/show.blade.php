@extends('back.formation.layouts.app')

@section('title', $enseignant->user->name)
@section('page_title', $enseignant->user->name)
@section('page_subtitle', 'Profil de l\'enseignant')

@section('formation-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-graduate mr-2"></i>
                    Profil
                </h3>
            </div>
            <div class="card-body text-center">
                @if($enseignant->photo)
                    <img src="{{ asset('storage/' . $enseignant->photo) }}" class="rounded-circle mb-3" width="120" height="120">
                @else
                    <div class="avatar-circle mx-auto mb-3" style="width: 120px; height: 120px; font-size: 48px;">
                        {{ substr($enseignant->user->name, 0, 1) }}
                    </div>
                @endif
                <h4>{{ $enseignant->user->name }}</h4>
                <p class="text-muted">{{ $enseignant->user->email }}</p>
                
                <hr>
                
                <dl class="text-left">
                    <dt>Spécialité</dt>
                    <dd>{{ $enseignant->specialite ?? 'Non définie' }}</dd>
                    
                    <dt>Expérience</dt>
                    <dd>{{ $enseignant->annees_experience ?? 0 }} année(s)</dd>
                    
                    <dt>Diplôme</dt>
                    <dd>{{ $enseignant->diplome ?? 'Non renseigné' }}</dd>
                    
                    <dt>Statut</dt>
                    <dd>
                        @if($enseignant->is_active)
                            <span class="badge badge-success">Actif</span>
                        @else
                            <span class="badge badge-secondary">Inactif</span>
                        @endif
                    </dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('back.formation.enseignants.edit', $enseignant) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <a href="{{ route('back.formation.enseignants.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book mr-2"></i>
                    Biographie
                </h3>
            </div>
            <div class="card-body">
                <p>{{ $enseignant->biographie ?? 'Aucune biographie disponible.' }}</p>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Compétences
                </h3>
            </div>
            <div class="card-body">
                @if($enseignant->competences)
                    @foreach($enseignant->competences as $competence)
                        <span class="badge badge-primary badge-lg mr-2 mb-2 p-2">{{ $competence }}</span>
                    @endforeach
                @else
                    <p class="text-muted">Aucune compétence renseignée</p>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chalkboard mr-2"></i>
                    Cours enseignés
                </h3>
            </div>
            <div class="card-body p-0">
                @if($enseignant->cours->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($enseignant->cours as $cour)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $cour->titre }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $cour->module->titre ?? 'N/A' }}</small>
                                </div>
                                <span class="badge badge-info">{{ $cour->pivot->role ?? 'principal' }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-chalkboard fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucun cours assigné</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection