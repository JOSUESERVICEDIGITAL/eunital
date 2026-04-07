@extends('back.formation.layouts.app')

@section('title', 'Enseignants')
@section('page_title', 'Gestion des enseignants')
@section('page_subtitle', 'Liste des formateurs et enseignants')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chalkboard-user mr-2"></i>
            Enseignants
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <a href="{{ route('back.formation.enseignants.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Ajouter un enseignant
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Enseignant</th>
                        <th>Spécialité</th>
                        <th>Expérience</th>
                        <th>Cours</th>
                        <th>Statut</th>
                        <th style="width: 100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enseignants as $enseignant)
                    <tr>
                        <td>{{ $enseignant->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($enseignant->photo)
                                    <img src="{{ asset('storage/' . $enseignant->photo) }}" class="rounded-circle mr-2" width="40" height="40">
                                @else
                                    <div class="avatar-circle mr-2" style="width: 40px; height: 40px; font-size: 16px;">
                                        {{ substr($enseignant->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <strong>{{ $enseignant->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $enseignant->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $enseignant->specialite ?? '-' }}</td>
                        <td>{{ $enseignant->annees_experience ?? 0 }} an(s)</td>
                        <td><span class="badge badge-info">{{ $enseignant->cours->count() }}</span></td>
                        <td>
                            @if($enseignant->is_active)
                                <span class="badge badge-success">Actif</span>
                            @else
                                <span class="badge badge-secondary">Inactif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.enseignants.show', $enseignant) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('back.formation.enseignants.edit', $enseignant) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('back.formation.enseignants.destroy', $enseignant) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-chalkboard-user fa-3x text-muted mb-3 d-block"></i>
                            Aucun enseignant trouvé
                            <br>
                            <a href="{{ route('back.formation.enseignants.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Ajouter le premier enseignant
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $enseignants])
    </div>
</div>
@endsection