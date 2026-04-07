@extends('back.juridique.layouts.app')
@section('title', 'Modifier démarche')
@section('page_title', 'Modification')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-edit"></i> Modifier</h3></div>
            <form action="{{ route('back.juridique.demarches.update', $demarcheAdministrative) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">@include('back.juridique.demarches.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Mettre à jour</button><a href="{{ route('back.juridique.demarches.show', $demarcheAdministrative) }}" class="btn btn-info">Voir</a><a href="{{ route('back.juridique.demarches.index') }}" class="btn btn-secondary">Retour</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-header">Statistiques</div><div class="card-body"><dl><dt>Créé le</dt><dd>{{ $demarcheAdministrative->created_at->format('d/m/Y') }}</dd><dt>Dernière modification</dt><dd>{{ $demarcheAdministrative->updated_at->format('d/m/Y') }}</dd></dl></div></div>
    </div>
</div>
@endsection