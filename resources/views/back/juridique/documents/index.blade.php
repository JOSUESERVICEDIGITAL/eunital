@extends('back.juridique.layouts.app')

@section('title', 'Documents')
@section('page_title', 'Gestion des documents')
@section('page_subtitle', 'Liste et suivi de tous les documents juridiques')

@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-alt mr-2"></i>
            Tous les documents
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.juridique.documents.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouveau document
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
                        <th>Numéro</th>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Version</th>
                        <th>Date création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $doc)
                    <tr>
                        <td>{{ $doc->id }}</td>
                        <td><code>{{ $doc->numero_unique }}</code></td>
                        <td>
                            <strong>{{ $doc->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($doc->description, 50) }}</small>
                        </td>
                        <td><span class="badge" style="background: {{ $doc->typeDocument->couleur ?? '#6c757d' }}20; color: {{ $doc->typeDocument->couleur ?? '#6c757d' }}">
                            <i class="{{ $doc->typeDocument->icon ?? 'fa-file' }}"></i> {{ $doc->typeDocument->nom ?? '-' }}
                        </span></td>
                        <td>@include('back.juridique.partials.status-badge', ['status' => $doc->statut])</td>
                        <td><span class="badge badge-secondary">v{{ $doc->version }}</span></td>
                        <td>{{ $doc->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.juridique.documents.show', $doc) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('back.juridique.documents.edit', $doc) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('back.juridique.documents.generer-pdf', $doc) }}" class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-file-pdf"></i></a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-4">Aucun document trouvé</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.juridique.partials.pagination', ['items' => $documents])
    </div>
</div>

<!-- Modal Filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET">
                <div class="modal-header"><h5 class="modal-title">Filtrer les documents</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                <div class="modal-body">
                    <div class="form-group"><label>Type</label><select name="type_id" class="form-control"><option value="">Tous</option>@foreach($typesDocuments ?? [] as $type)<option value="{{ $type->id }}">{{ $type->nom }}</option>@endforeach</select></div>
                    <div class="form-group"><label>Statut</label><select name="statut" class="form-control"><option value="">Tous</option><option value="brouillon">Brouillon</option><option value="en_attente">En attente</option><option value="signe">Signé</option><option value="valide">Validé</option></select></div>
                    <div class="row"><div class="col-md-6"><div class="form-group"><label>Date début</label><input type="date" name="date_debut" class="form-control"></div></div>
                    <div class="col-md-6"><div class="form-group"><label>Date fin</label><input type="date" name="date_fin" class="form-control"></div></div></div>
                </div>
                <div class="modal-footer"><a href="{{ route('back.juridique.documents.index') }}" class="btn btn-secondary">Réinitialiser</a><button type="submit" class="btn btn-primary">Appliquer</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
