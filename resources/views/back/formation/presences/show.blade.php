@extends('back.formation.layouts.app')

@section('title', 'Détails présence')
@section('page_title', 'Détails de la présence')
@section('page_subtitle', 'Informations détaillées de la présence')

@section('formation-content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations générales
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Étudiant</dt>
                    <dd class="col-sm-8">
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle mr-2" style="width: 40px; height: 40px; font-size: 16px;">
                                {{ substr($presence->inscription->user->name, 0, 1) }}
                            </div>
                            <div>
                                <strong>{{ $presence->inscription->user->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $presence->inscription->user->email }}</small>
                            </div>
                        </div>
                    </dd>
                    
                    <dt class="col-sm-4">Cours</dt>
                    <dd class="col-sm-8">
                        <a href="{{ route('back.formation.cours.show', $presence->cour) }}" class="text-info">
                            {{ $presence->cour->titre }}
                        </a>
                        <br>
                        <small class="text-muted">Module: {{ $presence->cour->module->titre }}</small>
                    </dd>
                    
                    <dt class="col-sm-4">Date</dt>
                    <dd class="col-sm-8">
                        @if($presence->date_debut)
                            {{ \Carbon\Carbon::parse($presence->date_debut)->format('d/m/Y') }}
                        @else
                            <span class="text-muted">Non définie</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Heure début</dt>
                    <dd class="col-sm-8">
                        @if($presence->date_debut)
                            {{ \Carbon\Carbon::parse($presence->date_debut)->format('H:i:s') }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Heure fin</dt>
                    <dd class="col-sm-8">
                        @if($presence->date_fin)
                            {{ \Carbon\Carbon::parse($presence->date_fin)->format('H:i:s') }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Durée connexion</dt>
                    <dd class="col-sm-8">
                        @if($presence->duree_connexion)
                            <span class="badge badge-info">
                                {{ floor($presence->duree_connexion / 60) }} minutes 
                                {{ $presence->duree_connexion % 60 }} secondes
                            </span>
                        @else
                            <span class="text-muted">Non mesurée</span>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Statut et suivi
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Statut</dt>
                    <dd class="col-sm-8">
                        @if($presence->present)
                            <span class="badge badge-success badge-lg">Présent</span>
                        @else
                            <span class="badge badge-danger badge-lg">Absent</span>
                        @endif
                        @if($presence->statut != 'present' && $presence->statut != 'absent')
                            <br>
                            <span class="badge badge-{{ $presence->statut == 'retard' ? 'warning' : 'info' }} mt-1">
                                {{ ucfirst($presence->statut) }}
                            </span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Code d'accès</dt>
                    <dd class="col-sm-8">
                        @if($presence->code_acces)
                            <code class="code-display" onclick="copyToClipboard('{{ $presence->code_acces }}')">
                                {{ $presence->code_acces }}
                                <i class="fas fa-copy ml-2"></i>
                            </code>
                        @else
                            <span class="text-muted">Non utilisé</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Enregistré le</dt>
                    <dd class="col-sm-8">{{ $presence->created_at->format('d/m/Y H:i:s') }}</dd>
                    
                    <dt class="col-sm-4">Dernière modification</dt>
                    <dd class="col-sm-8">{{ $presence->updated_at->format('d/m/Y H:i:s') }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.presences.edit', $presence) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="{{ route('back.formation.presences.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-simple mr-2"></i>
                    Historique des présences
                </h3>
            </div>
            <div class="card-body p-0">
                @php
                    $historique = $presence->inscription->presences()
                        ->with('cour')
                        ->where('id', '!=', $presence->id)
                        ->orderBy('date_debut', 'desc')
                        ->limit(5)
                        ->get();
                @endphp
                
                @if($historique->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($historique as $item)
                        <a href="{{ route('back.formation.presences.show', $item) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->cour->titre }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($item->date_debut)->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                                <div>
                                    @if($item->present)
                                        <span class="badge badge-success">Présent</span>
                                    @else
                                        <span class="badge badge-danger">Absent</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-history fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucun autre historique</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection