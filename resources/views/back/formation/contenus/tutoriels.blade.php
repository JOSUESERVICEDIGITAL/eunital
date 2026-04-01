@extends('back.formation.layouts.app')

@section('title', 'Tutoriels')
@section('page_title', 'Tutoriels et guides')
@section('page_subtitle', 'Liste des tutoriels pas-à-pas')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chalkboard text-purple mr-2"></i>
            Tutoriels
        </h3>
        <div class="card-tools">
            <a href="{{ route('back.formation.contenus.create', ['type' => 'tutoriel']) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Ajouter un tutoriel
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($contenus as $contenu)
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-chalkboard text-purple fa-lg mr-2"></i>
                            <h5 class="mb-0">
                                <a href="{{ route('back.formation.contenus.show', $contenu) }}" class="text-dark">
                                    {{ $contenu->titre }}
                                </a>
                            </h5>
                            @if($contenu->is_visible)
                                <span class="badge badge-success ml-2">Visible</span>
                            @else
                                <span class="badge badge-secondary ml-2">Masqué</span>
                            @endif
                        </div>
                        <p class="mb-2">{{ Str::limit($contenu->contenu, 200) }}</p>
                        <div class="d-flex flex-wrap">
                            <span class="badge badge-info mr-2">
                                <i class="fas fa-book"></i> {{ $contenu->chapitre->cour->titre ?? 'N/A' }}
                            </span>
                            <span class="badge badge-secondary mr-2">
                                <i class="fas fa-layer-group"></i> {{ $contenu->chapitre->titre }}
                            </span>
                            @if($contenu->fichier)
                                <span class="badge badge-success">
                                    <i class="fas fa-paperclip"></i> Fichier joint
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="btn-group">
                            <a href="{{ route('back.formation.contenus.show', $contenu) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('back.formation.contenus.edit', $contenu) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-{{ $contenu->is_visible ? 'warning' : 'success' }}" 
                                    onclick="toggleVisibility({{ $contenu->id }}, {{ $contenu->is_visible ? 'false' : 'true' }})">
                                <i class="fas fa-{{ $contenu->is_visible ? 'eye-slash' : 'eye' }}"></i>
                            </button>
                            <form action="{{ route('back.formation.contenus.destroy', $contenu) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="fas fa-chalkboard fa-4x text-muted mb-3"></i>
                <p class="text-muted">Aucun tutoriel trouvé</p>
                <a href="{{ route('back.formation.contenus.create', ['type' => 'tutoriel']) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter un tutoriel
                </a>
            </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $contenus])
    </div>
</div>

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