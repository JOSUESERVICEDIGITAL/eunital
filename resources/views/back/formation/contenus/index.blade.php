@extends('back.formation.layouts.app')

@section('title', 'Contenus pédagogiques')
@section('page_title', 'Gestion des contenus')
@section('page_subtitle', 'Liste et organisation des contenus par chapitre')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-alt mr-2"></i>
            Tous les contenus
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.contenus.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouveau contenu
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    时
                        <th style="width: 50px">#</th>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Chapitre</th>
                        <th>Cours</th>
                        <th style="width: 80px">Fichier</th>
                        <th style="width: 100px">Statut</th>
                        <th style="width: 120px">Actions</th>
                    </thead>
                <tbody>
                    @forelse($contenus as $contenu)
                    <tr>
                        <td>{{ $contenu->id }}</td>
                        <td>
                            <strong>{{ $contenu->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($contenu->contenu, 50) }}</small>
                        </td>
                        <td>
                            @switch($contenu->type)
                                @case('video')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-video"></i> Vidéo
                                    </span>
                                    @break
                                @case('document')
                                    <span class="badge badge-primary">
                                        <i class="fas fa-file-alt"></i> Document
                                    </span>
                                    @break
                                @case('image')
                                    <span class="badge badge-success">
                                        <i class="fas fa-image"></i> Image
                                    </span>
                                    @break
                                @case('audio')
                                    <span class="badge badge-warning">
                                        <i class="fas fa-headphones"></i> Audio
                                    </span>
                                    @break
                                @case('quiz')
                                    <span class="badge badge-info">
                                        <i class="fas fa-puzzle-piece"></i> Quiz
                                    </span>
                                    @break
                                @case('exercice')
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-code"></i> Exercice
                                    </span>
                                    @break
                                @case('tutoriel')
                                    <span class="badge badge-purple">
                                        <i class="fas fa-chalkboard"></i> Tutoriel
                                    </span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('back.formation.chapitres.show', $contenu->chapitre) }}" class="text-info">
                                {{ Str::limit($contenu->chapitre->titre, 30) }}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-secondary">{{ $contenu->chapitre->cour->titre ?? 'N/A' }}</span>
                        </td>
                        <td>
                            @if($contenu->fichier)
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle"></i> Oui
                                </span>
                                @if($contenu->telechargeable)
                                    <br>
                                    <span class="badge badge-info">Téléchargeable</span>
                                @endif
                            @else
                                <span class="badge badge-secondary">Non</span>
                            @endif
                        </td>
                        <td>
                            @if($contenu->is_visible)
                                <span class="badge badge-success">Visible</span>
                            @else
                                <span class="badge badge-secondary">Masqué</span>
                            @endif
                        </td>
                        <td>
                            @include('back.formation.partials.table-actions', [
                                'showRoute' => route('back.formation.contenus.show', $contenu),
                                'editRoute' => route('back.formation.contenus.edit', $contenu),
                                'deleteRoute' => route('back.formation.contenus.destroy', $contenu),
                                'customActions' => '
                                    <button type="button" class="btn btn-sm btn-' . ($contenu->is_visible ? 'warning' : 'success') . '" 
                                            onclick="toggleVisibility(' . $contenu->id . ', ' . ($contenu->is_visible ? 'false' : 'true') . ')" 
                                            title="' . ($contenu->is_visible ? 'Masquer' : 'Afficher') . '">
                                        <i class="fas fa-' . ($contenu->is_visible ? 'eye-slash' : 'eye') . '"></i>
                                    </button>
                                '
                            ])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3 d-block"></i>
                            Aucun contenu trouvé
                            <br>
                            <a href="{{ route('back.formation.contenus.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Créer le premier contenu
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Affichage de {{ $contenus->firstItem() ?? 0 }} à {{ $contenus->lastItem() ?? 0 }} sur {{ $contenus->total() }} contenus
            </div>
            @include('back.formation.partials.pagination', ['items' => $contenus])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.contenus.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les contenus</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="">Tous les types</option>
                            <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Vidéo</option>
                            <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>Document</option>
                            <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                            <option value="quiz" {{ request('type') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                            <option value="exercice" {{ request('type') == 'exercice' ? 'selected' : '' }}>Exercice</option>
                            <option value="tutoriel" {{ request('type') == 'tutoriel' ? 'selected' : '' }}>Tutoriel</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chapitre</label>
                        <select name="chapitre_id" class="form-control">
                            <option value="">Tous les chapitres</option>
                            @foreach($chapitres ?? [] as $chapitre)
                            <option value="{{ $chapitre->id }}" {{ request('chapitre_id') == $chapitre->id ? 'selected' : '' }}>
                                {{ $chapitre->titre }} ({{ $chapitre->cour->titre ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Visibilité</label>
                        <select name="is_visible" class="form-control">
                            <option value="">Tous</option>
                            <option value="1" {{ request('is_visible') == '1' ? 'selected' : '' }}>Visible</option>
                            <option value="0" {{ request('is_visible') == '0' ? 'selected' : '' }}>Masqué</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.contenus.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleVisibility(id, show) {
        $.ajax({
            url: '/back/formation/contenus/' + id + '/toggle-visibility',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PATCH'
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            }
        });
    }
</script>
@endpush