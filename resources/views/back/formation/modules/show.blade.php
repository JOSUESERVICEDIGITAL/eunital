@extends('back.formation.layouts.app')

@section('title', $module->titre)
@section('page_title', $module->titre)
@section('page_subtitle', 'Détails du module et liste des cours associés')

@section('formation-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations générales
                </h3>
            </div>
            <div class="card-body">
                @if($module->image_couverture)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/' . $module->image_couverture) }}" 
                             alt="{{ $module->titre }}" 
                             class="img-fluid rounded" 
                             style="max-height: 200px;">
                    </div>
                @endif
                
                <dl class="row">
                    <dt class="col-sm-4">Catégorie</dt>
                    <dd class="col-sm-8">
                        <a href="{{ route('back.formation.categories-modules.show', $module->categorie) }}" class="text-info">
                            {{ $module->categorie->nom }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-4">Niveau</dt>
                    <dd class="col-sm-8">
                        @include('back.formation.partials.status-badge', ['status' => $module->niveau])
                    </dd>
                    
                    <dt class="col-sm-4">Durée estimée</dt>
                    <dd class="col-sm-8">
                        @php
                            $heures = floor(($stats['duree_totale'] ?? 0) / 60);
                            $minutes = ($stats['duree_totale'] ?? 0) % 60;
                        @endphp
                        <i class="fas fa-clock"></i> 
                        {{ $heures > 0 ? $heures . 'h ' : '' }}{{ $minutes > 0 ? $minutes . 'min' : '0min' }}
                    </dd>
                    
                    <dt class="col-sm-4">Statut</dt>
                    <dd class="col-sm-8">
                        @include('back.formation.partials.status-badge', ['status' => $module->is_active ? 'active' : 'inactive'])
                    </dd>
                    
                    <dt class="col-sm-4">Créé par</dt>
                    <dd class="col-sm-8">{{ $module->createur->name ?? 'N/A' }}</dd>
                    
                    <dt class="col-sm-4">Créé le</dt>
                    <dd class="col-sm-8">{{ $module->created_at->format('d/m/Y H:i') }}</dd>
                </dl>
                
                <hr>
                
                <h6>Description</h6>
                <p class="text-muted">{{ $module->description }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('back.formation.modules.edit', $module) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <a href="{{ route('back.formation.modules.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple mr-2"></i>
                    Statistiques
                </h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Cours</span>
                                <span class="info-box-number">{{ $stats['nb_cours'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text">Inscrits</span>
                                <span class="info-box-number">{{ $stats['nb_inscrits'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress-group">
                            <span class="progress-text">Progression moyenne</span>
                            <span class="progress-number"><b>{{ round($stats['progression_moyenne'], 1) }}%</b></span>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-primary" style="width: {{ $stats['progression_moyenne'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book mr-2"></i>
                    Cours du module
                </h3>
                <div class="card-tools">
                    <a href="{{ route('back.formation.cours.create', ['module_id' => $module->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Ajouter un cours
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($module->cours->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($module->cours as $index => $cour)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-secondary mr-2">{{ $index + 1 }}</span>
                                        <h5 class="mb-0">
                                            <a href="{{ route('back.formation.cours.show', $cour) }}" class="text-dark">
                                                {{ $cour->titre }}
                                            </a>
                                        </h5>
                                        @include('back.formation.partials.status-badge', ['status' => $cour->is_published ? 'publie' : 'brouillon'])
                                    </div>
                                    <p class="mb-2 text-muted">{{ Str::limit($cour->description, 150) }}</p>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge badge-info mr-2">
                                            <i class="fas fa-layer-group"></i> {{ $cour->chapitres_count }} chapitres
                                        </span>
                                        <span class="badge badge-success mr-2">
                                            <i class="fas fa-users"></i> {{ $cour->utilisateurs_count }} étudiants
                                        </span>
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock"></i> {{ $cour->duree_estimee ?? 0 }} min
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    @include('back.formation.partials.table-actions', [
                                        'showRoute' => route('back.formation.cours.show', $cour),
                                        'editRoute' => route('back.formation.cours.edit', $cour),
                                        'deleteRoute' => route('back.formation.cours.destroy', $cour)
                                    ])
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun cours n'est encore associé à ce module</p>
                        <a href="{{ route('back.formation.cours.create', ['module_id' => $module->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Créer le premier cours
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    Derniers inscrits
                </h3>
            </div>
            <div class="card-body p-0">
                @if($module->inscriptions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Date d'inscription</th>
                                    <th>Progression</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($module->inscriptions as $inscription)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle mr-2" style="width: 32px; height: 32px; font-size: 14px;">
                                                {{ substr($inscription->user->name, 0, 1) }}
                                            </div>
                                            {{ $inscription->user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $inscription->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="progress" style="height: 6px; width: 100px;">
                                            <div class="progress-bar" style="width: {{ $inscription->progression }}%"></div>
                                        </div>
                                        <small>{{ $inscription->progression }}%</small>
                                    </td>
                                    <td>
                                        @include('back.formation.partials.status-badge', ['status' => $inscription->statut])
                                    </td>
                                    <td>
                                        <a href="{{ route('back.formation.inscriptions.show', $inscription) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-user-graduate fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucune inscription pour le moment</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection