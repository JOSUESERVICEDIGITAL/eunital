@extends('back.juridique.layouts.app')
@section('title', 'Modifier évaluation')
@section('page_title', 'Modification de l\'évaluation')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-edit"></i> Modifier</h3></div>
            <form action="{{ route('back.juridique.conformites.update', $conformite) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">@include('back.juridique.conformites.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Mettre à jour</button><a href="{{ route('back.juridique.conformites.show', $conformite) }}" class="btn btn-info">Voir</a><a href="{{ route('back.juridique.conformites.index') }}" class="btn btn-secondary">Retour</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Statistiques</div>
            <div class="card-body">
                <dl><dt>Texte légal</dt><dd>{{ $conformite->legalite->titre }}</dd>
                <dt>Entreprise</dt><dd>{{ $conformite->entreprise->nom ?? '-' }}</dd>
                <dt>Créé le</dt><dd>{{ $conformite->created_at->format('d/m/Y') }}</dd>
                <dt>Dernière modification</dt><dd>{{ $conformite->updated_at->format('d/m/Y') }}</dd></dl>
            </div>
        </div>
    </div>
</div>
@endsection