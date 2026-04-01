@extends('back.formation.layouts.app')

@section('title', $categorieModule->nom ?? 'Catégorie')
@section('page_title', $categorieModule->nom ?? 'Catégorie')
@section('page_subtitle', 'Détails de la catégorie et modules associés')

@section('formation-content')
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
                    <dt class="col-sm-4">Nom</dt>
                    <dd class="col-sm-8">{{ $categorieModule->nom ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Slug</dt>
                    <dd class="col-sm-8"><code>{{ $categorieModule->slug ?? 'N/A' }}</code></dd>

                    <dt class="col-sm-4">Description</dt>
                    <dd class="col-sm-8">{{ $categorieModule->description ?? 'Aucune description' }}</dd>

                    <dt class="col-sm-4">Ordre</dt>
                    <dd class="col-sm-8">{{ $categorieModule->ordre ?? 0 }}</dd>

                    <dt class="col-sm-4">Statut</dt>
                    <dd class="col-sm-8">
                        @include('back.formation.partials.status-badge', ['status' => ($categorieModule->is_active ?? false) ? 'active' : 'inactive'])
                    </dd>

                    <dt class="col-sm-4">Créé le</dt>
                    <dd class="col-sm-8">
                        @if(isset($categorieModule->created_at) && $categorieModule->created_at)
                            {{ $categorieModule->created_at->format('d/m/Y H:i') }}
                        @else
                            <span class="text-muted">Non défini</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4">Modifié le</dt>
                    <dd class="col-sm-8">
                        @if(isset($categorieModule->updated_at) && $categorieModule->updated_at)
                            {{ $categorieModule->updated_at->format('d/m/Y H:i') }}
                        @else
                            <span class="text-muted">Non défini</span>
                        @endif
                    </dd>
                </dl>
            </div>
            <div class="card-footer">
                @if(isset($categorieModule) && $categorieModule->id)
                    <a href="{{ route('back.formation.categories-modules.edit', ['categories_module' => $categorieModule->id]) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                @endif
                <a href="{{ route('back.formation.categories-modules.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-folder-open mr-2"></i>
                    Modules associés
                </h3>
                @if(isset($categorieModule) && $categorieModule->id)
                <div class="card-tools">
                    <a href="{{ route('back.formation.modules.create', ['categorie' => $categorieModule->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Ajouter un module
                    </a>
                </div>
                @endif
            </div>
            <div class="card-body p-0">
                @if(isset($categorieModule->modules) && $categorieModule->modules->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($categorieModule->modules as $module)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">
                                        <a href="{{ route('back.formation.modules.show', $module->id) }}" class="text-dark">
                                            {{ $module->titre }}
                                        </a>
                                    </h5>
                                    <p class="mb-1 text-muted">{{ Str::limit($module->description, 100) }}</p>
                                    <div class="mt-2">
                                        @include('back.formation.partials.status-badge', ['status' => $module->niveau])
                                        <span class="badge badge-info ml-2">
                                            <i class="fas fa-book"></i> {{ $module->cours_count ?? 0 }} cours
                                        </span>
                                        <span class="badge badge-success">
                                            <i class="fas fa-users"></i> {{ $module->inscriptions_count ?? 0 }} inscrits
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('back.formation.modules.show', $module->id) }}" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('back.formation.modules.edit', $module->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun module associé à cette catégorie</p>
                        @if(isset($categorieModule) && $categorieModule->id)
                        <a href="{{ route('back.formation.modules.create', ['categorie' => $categorieModule->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Créer un module
                        </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
