@extends('back.juridique.layouts.app')

@section('title', 'Modèles de documents')
@section('page_title', 'Modèles de documents')
@section('page_subtitle', 'Bibliothèque de modèles pour la génération de documents')

@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-copy mr-2"></i>
            Modèles disponibles
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <a href="{{ route('back.juridique.modeles.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouveau modèle
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Type de document</th>
                        <th>Version</th>
                        <th>Utilisations</th>
                        <th>Statut</th>
                        <th>Défaut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($modeles as $modele)
                    <tr>
                        <td>{{ $modele->id }}</td>
                        <td>
                            <strong>{{ $modele->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ $modele->slug }}</small>
                        </td>
                        <td>{{ $modele->typeDocument->nom ?? '-' }}</td>
                        <td><span class="badge badge-info">v{{ $modele->version }}</span></td>
                        <td><span class="badge badge-primary">{{ $modele->documents_count ?? 0 }}</span></td>
                        <td>@include('back.juridique.partials.status-badge', ['status' => $modele->is_active ? 'actif' : 'inactif'])</td>
                        <td>
                            @if($modele->is_default)
                                <span class="badge badge-success">Par défaut</span>
                            @else
                                <button class="btn btn-sm btn-outline-success" onclick="setDefault({{ $modele->id }})">
                                    <i class="fas fa-star"></i> Définir
                                </button>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.juridique.modeles.show', $modele) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('back.juridique.modeles.edit', $modele) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-sm btn-{{ $modele->is_active ? 'secondary' : 'success' }}"
                                        onclick="toggleActive({{ $modele->id }}, {{ $modele->is_active ? 'false' : 'true' }})">
                                    <i class="fas fa-{{ $modele->is_active ? 'ban' : 'check' }}"></i>
                                </button>
                                <form action="{{ route('back.juridique.modeles.destroy', $modele) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-4">Aucun modèle trouvé</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.juridique.partials.pagination', ['items' => $modeles])
    </div>
</div>
@endsection

@push('juridique-scripts')
<script>
    function toggleActive(id, activate) {
        $.ajax({ url: '/back/juridique/modeles/' + id + '/toggle-active', method: 'POST', data: { _token: '{{ csrf_token() }}', _method: 'PATCH' },
        success: function(r) { if(r.success) location.reload(); } });
    }
    function setDefault(id) {
        $.ajax({ url: '/back/juridique/modeles/' + id + '/set-default', method: 'POST', data: { _token: '{{ csrf_token() }}', _method: 'PATCH' },
        success: function(r) { if(r.success) location.reload(); } });
    }
</script>
@endpush
