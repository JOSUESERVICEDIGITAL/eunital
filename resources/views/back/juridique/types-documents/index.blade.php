@extends('back.juridique.layouts.app')

@section('title', 'Types de documents')
@section('page_title', 'Types de documents')
@section('page_subtitle', 'Gestion des catégories de documents juridiques')

@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-tags mr-2"></i>
            Liste des types de documents
        </h3>
        <div class="card-tools">
            <a href="{{ route('back.juridique.types-documents.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nouveau type
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                     <tr>
                        <th style="width: 50px">#</th>
                        <th>Nom</th>
                        <th>Code</th>
                        <th>Catégorie</th>
                        <th>Documents</th>
                        <th>Validité</th>
                        <th>Signature</th>
                        <th>Statut</th>
                        <th style="width: 100px">Actions</th>
                     </tr>
                </thead>
                <tbody>
                    @forelse($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>
                            <strong>{{ $type->nom }}</strong>
                            <br>
                            <small class="text-muted">{{ $type->slug }}</small>
                        </td>
                        <td><code>{{ $type->code }}</code></td>
                        <td>
                            <span class="badge" style="background: {{ $type->couleur }}20; color: {{ $type->couleur }}">
                                <i class="{{ $type->icon }}"></i> {{ $type->categorie_label }}
                            </span>
                        </td>
                        <td><span class="badge badge-info">{{ $type->documents_count }}</span></td>
                        <td>{{ $type->duree_validite_formatee }}</td>
                        <td>
                            @if($type->necessite_signature)
                                <span class="badge badge-success">Oui</span>
                            @else
                                <span class="badge badge-secondary">Non</span>
                            @endif
                        </td>
                        <td>@include('back.juridique.partials.status-badge', ['status' => $type->is_active ? 'actif' : 'inactif'])</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.juridique.types-documents.show', $type) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('back.juridique.types-documents.edit', $type) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-{{ $type->is_active ? 'secondary' : 'success' }}"
                                        onclick="toggleActive({{ $type->id }}, {{ $type->is_active ? 'false' : 'true' }})">
                                    <i class="fas fa-{{ $type->is_active ? 'ban' : 'check' }}"></i>
                                </button>
                                <form action="{{ route('back.juridique.types-documents.destroy', $type) }}" method="POST" class="d-inline">
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
                    <tr><td colspan="9" class="text-center py-4">Aucun type de document trouvé</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.juridique.partials.pagination', ['items' => $types])
    </div>
</div>
@endsection

@push('juridique-scripts')
<script>
    function toggleActive(id, activate) {
        $.ajax({
            url: '/back/juridique/types-documents/' + id + '/toggle-active',
            method: 'POST',
            data: { _token: '{{ csrf_token() }}', _method: 'PATCH' },
            success: function(r) { if(r.success) location.reload(); }
        });
    }
</script>
@endpush
