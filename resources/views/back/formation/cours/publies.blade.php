@extends('back.formation.layouts.app')

@section('title', 'Cours publiés')
@section('page_title', 'Cours publiés')
@section('page_subtitle', 'Liste des cours disponibles pour les apprenants')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-eye mr-2"></i>
            Cours publiés
        </h3>
        <div class="card-tools">
            <a href="{{ route('back.formation.cours.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nouveau cours
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Module</th>
                        <th>Niveau</th>
                        <th>Date de publication</th>
                        <th>Étudiants</th>
                        <th>Progression</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cours as $cour)
                    <tr>
                        <td>{{ $cour->id }}</td>
                        <td>
                            <strong>{{ $cour->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($cour->description, 50) }}</small>
                        </td>
                        <td>{{ $cour->module->titre ?? 'N/A' }}</td>
                        <td>@include('back.formation.partials.status-badge', ['status' => $cour->niveau_difficulte])</td>
                        <td>{{ $cour->published_at ? $cour->published_at->format('d/m/Y') : 'N/A' }}</td>
                        <td><span class="badge badge-success">{{ $cour->utilisateurs_count }}</span></td>
                        <td>
                            <div class="progress" style="height: 6px; width: 100px;">
                                <div class="progress-bar bg-primary" style="width: {{ $cour->progression_moyenne }}%"></div>
                            </div>
                            <small>{{ round($cour->progression_moyenne, 1) }}%</small>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.cours.show', $cour) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('back.formation.cours.edit', $cour) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-warning" onclick="togglePublish({{ $cour->id }}, false)">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-eye-slash fa-3x text-muted mb-3 d-block"></i>
                            Aucun cours publié
                            <br>
                            <a href="{{ route('back.formation.cours.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Créer un cours
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $cours])
    </div>
</div>
@endsection