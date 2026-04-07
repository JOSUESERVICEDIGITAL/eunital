@extends('back.juridique.layouts.app')

@section('title', $typeDocument->nom)
@section('page_title', $typeDocument->nom)
@section('page_subtitle', 'Détails du type de document')

@section('juridique-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-5">Nom</dt>
                    <dd class="col-sm-7">{{ $typeDocument->nom }}</dd>
                    <dt class="col-sm-5">Slug</dt>
                    <dd class="col-sm-7"><code>{{ $typeDocument->slug }}</code></dd>
                    <dt class="col-sm-5">Code</dt>
                    <dd class="col-sm-7"><code>{{ $typeDocument->code }}</code></dd>
                    <dt class="col-sm-5">Catégorie</dt>
                    <dd class="col-sm-7">
                        <span class="badge" style="background: {{ $typeDocument->couleur }}20; color: {{ $typeDocument->couleur }}">
                            <i class="{{ $typeDocument->icon }}"></i> {{ $typeDocument->categorie_label }}
                        </span>
                    </dd>
                    <dt class="col-sm-5">Description</dt>
                    <dd class="col-sm-7">{{ $typeDocument->description ?? 'Aucune' }}</dd>
                    <dt class="col-sm-5">Durée validité</dt>
                    <dd class="col-sm-7">{{ $typeDocument->duree_validite_formatee }}</dd>
                    <dt class="col-sm-5">Signature requise</dt>
                    <dd class="col-sm-7">{{ $typeDocument->necessite_signature ? 'Oui' : 'Non' }}</dd>
                    <dt class="col-sm-5">Timbre fiscal</dt>
                    <dd class="col-sm-7">{{ $typeDocument->necessite_timbre ? 'Oui' : 'Non' }}</dd>
                    <dt class="col-sm-5">Statut</dt>
                    <dd class="col-sm-7">@include('back.juridique.partials.status-badge', ['status' => $typeDocument->is_active ? 'actif' : 'inactif'])</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('back.juridique.types-documents.edit', $typeDocument) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <a href="{{ route('back.juridique.types-documents.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt mr-2"></i>
                    Documents associés
                </h3>
                <div class="card-tools">
                    <a href="{{ route('back.juridique.documents.create', ['type' => $typeDocument->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Nouveau document
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                             <tr>
                                <th>Titre</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                             </tr>
                        </thead>
                        <tbody>
                            @forelse($typeDocument->documents as $doc)
                            <tr>
                                <td>{{ $doc->titre }}</td>
                                <td>@include('back.juridique.partials.status-badge', ['status' => $doc->statut])</td>
                                <td>{{ $doc->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('back.juridique.documents.show', $doc) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">Aucun document</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
