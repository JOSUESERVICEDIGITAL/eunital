@extends('back.formation.layouts.app')

@section('title', 'Cours en brouillon')
@section('page_title', 'Cours en brouillon')
@section('page_subtitle', 'Liste des cours en cours de rédaction')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-pencil-alt mr-2"></i>
            Cours en brouillon
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
                        <th>Créé le</th>
                        <th>Chapitres</th>
                        <th>Contenus</th>
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
                        <td>{{ $cour->created_at->format('d/m/Y') }}</td>
                        <td><span class="badge badge-info">{{ $cour->chapitres_count }}</span></td>
                        <td><span class="badge badge-primary">{{ $cour->contenus_count ?? 0 }}</span></td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.cours.edit', $cour) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Continuer
                                </a>
                                <button type="button" class="btn btn-sm btn-success" onclick="togglePublish({{ $cour->id }}, true)">
                                    <i class="fas fa-eye"></i> Publier
                                </button>
                                <form action="{{ route('back.formation.cours.destroy', $cour) }}" method="POST" class="d-inline">
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
                            <i class="fas fa-pencil-alt fa-3x text-muted mb-3 d-block"></i>
                            Aucun cours en brouillon
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