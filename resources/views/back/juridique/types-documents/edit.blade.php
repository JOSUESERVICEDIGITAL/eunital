@extends('back.juridique.layouts.app')

@section('title', 'Modifier le type de document')
@section('page_title', 'Modification du type')
@section('page_subtitle', $typeDocument->nom)

@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier le type
                </h3>
            </div>
            <form action="{{ route('back.juridique.types-documents.update', $typeDocument) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.juridique.types-documents.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.juridique.types-documents.show', $typeDocument) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('back.juridique.types-documents.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Statistiques
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-7">Documents associés</dt>
                    <dd class="col-sm-5">{{ $typeDocument->documents_count ?? 0 }}</dd>
                    <dt class="col-sm-7">Modèles associés</dt>
                    <dd class="col-sm-5">{{ $typeDocument->modeles_count ?? 0 }}</dd>
                    <dt class="col-sm-7">Créé le</dt>
                    <dd class="col-sm-5">{{ $typeDocument->created_at->format('d/m/Y') }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
