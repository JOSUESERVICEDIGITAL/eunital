@extends('back.juridique.layouts.app')

@section('title', $modeleDocument->titre)
@section('page_title', $modeleDocument->titre)
@section('page_subtitle', 'Détails du modèle de document')

@section('juridique-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle"></i> Informations</h3></div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Titre</dt><dd class="col-sm-8">{{ $modeleDocument->titre }}</dd>
                    <dt class="col-sm-4">Slug</dt><dd class="col-sm-8"><code>{{ $modeleDocument->slug }}</code></dd>
                    <dt class="col-sm-4">Type</dt><dd class="col-sm-8">{{ $modeleDocument->typeDocument->nom ?? '-' }}</dd>
                    <dt class="col-sm-4">Version</dt><dd class="col-sm-8">v{{ $modeleDocument->version }}</dd>
                    <dt class="col-sm-4">Variables</dt><dd class="col-sm-8">{{ count($modeleDocument->variables ?? []) }} variable(s)</dd>
                    <dt class="col-sm-4">Champs requis</dt><dd class="col-sm-8">{{ count($modeleDocument->champs_requis ?? []) }} champ(s)</dd>
                    <dt class="col-sm-4">Statut</dt><dd class="col-sm-8">@include('back.juridique.partials.status-badge', ['status' => $modeleDocument->is_active ? 'actif' : 'inactif'])</dd>
                    <dt class="col-sm-4">Défaut</dt><dd class="col-sm-8">{{ $modeleDocument->is_default ? 'Oui' : 'Non' }}</dd>
                </dl>
                <hr><h6>Description</h6><p>{{ $modeleDocument->description }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('back.juridique.modeles.edit', $modeleDocument) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a>
                <a href="{{ route('back.juridique.generation.create', ['modele' => $modeleDocument->id]) }}" class="btn btn-success"><i class="fas fa-file-alt"></i> Générer</a>
                <a href="{{ route('back.juridique.modeles.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-code"></i> Aperçu du contenu HTML</h3></div>
            <div class="card-body">
                <pre class="bg-light p-3 rounded" style="max-height: 400px; overflow: auto;">{{ $modeleDocument->contenu_html }}</pre>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-list"></i> Variables disponibles</h3></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Variables</h6>
                        <ul class="list-group">
                            @foreach($modeleDocument->variables ?? [] as $var)
                            <li class="list-group-item"><code>{{ $var }}</code></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Champs requis</h6>
                        <ul class="list-group">
                            @foreach($modeleDocument->champs_requis ?? [] as $champ)
                            <li class="list-group-item text-danger"><code>{{ $champ }}</code></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
