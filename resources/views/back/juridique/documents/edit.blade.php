@extends('back.juridique.layouts.app')

@section('title', 'Modifier le document')
@section('page_title', 'Modification du document')
@section('page_subtitle', $document->titre)

@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-edit mr-2"></i> Modifier le document</h3></div>
            <form action="{{ route('back.juridique.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="card-body">
                    @include('back.juridique.documents.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button>
                    <a href="{{ route('back.juridique.documents.show', $document) }}" class="btn btn-info"><i class="fas fa-eye"></i> Voir</a>
                    <a href="{{ route('back.juridique.documents.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-chart-line"></i> Statistiques</h3></div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-7">Numéro unique</dt><dd class="col-sm-5"><code>{{ $document->numero_unique }}</code></dd>
                    <dt class="col-sm-7">Version</dt><dd class="col-sm-5">v{{ $document->version }}</dd>
                    <dt class="col-sm-7">Créé le</dt><dd class="col-sm-5">{{ $document->created_at->format('d/m/Y') }}</dd>
                    <dt class="col-sm-7">Dernière modification</dt><dd class="col-sm-5">{{ $document->updated_at->format('d/m/Y') }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
