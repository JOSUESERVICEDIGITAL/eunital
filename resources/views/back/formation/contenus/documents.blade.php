@extends('back.formation.layouts.app')

@section('title', 'Documents')
@section('page_title', 'Bibliothèque de documents')
@section('page_subtitle', 'Liste des documents PDF, Word, Excel, etc.')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-alt text-primary mr-2"></i>
            Documents
        </h3>
        <div class="card-tools">
            <a href="{{ route('back.formation.contenus.create', ['type' => 'document']) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Ajouter un document
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
                        <th>Type de fichier</th>
                        <th>Taille</th>
                        <th>Téléchargeable</th>
                        <th>Chapitre</th>
                        <th>Actions</th>
                    </tr>
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
                            @if($contenu->type_fichier)
                                <span class="badge badge-info">
                                    {{ strtoupper($contenu->type_fichier) }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($contenu->taille_formatee)
                                {{ $contenu->taille_formatee }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($contenu->telechargeable)
                                <span class="badge badge-success">Oui</span>
                            @else
                                <span class="badge badge-secondary">Non</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('back.formation.chapitres.show', $contenu->chapitre) }}" class="text-info">
                                {{ Str::limit($contenu->chapitre->titre, 30) }}
                            </a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.contenus.show', $contenu) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('back.formation.contenus.edit', $contenu) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($contenu->fichier && $contenu->telechargeable)
                                    <a href="{{ route('back.formation.contenus.download', $contenu) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endif
                                <form action="{{ route('back.formation.contenus.destroy', $contenu) }}" method="POST" class="d-inline">
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
                            <i class="fas fa-file-alt fa-3x text-muted mb-3 d-block"></i>
                            Aucun document trouvé
                            <br>
                            <a href="{{ route('back.formation.contenus.create', ['type' => 'document']) }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Ajouter un document
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $contenus])
    </div>
</div>
@endsection