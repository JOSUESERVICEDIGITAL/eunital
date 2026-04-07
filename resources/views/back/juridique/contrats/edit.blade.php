@extends('back.juridique.layouts.app')
@section('title', 'Modifier le contrat')
@section('page_title', 'Modification du contrat')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-edit"></i> Modifier le contrat</h3></div>
            <form action="{{ route('back.juridique.contrats.update', $contrat) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">@include('back.juridique.contrats.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button><a href="{{ route('back.juridique.contrats.show', $contrat) }}" class="btn btn-info"><i class="fas fa-eye"></i> Voir</a><a href="{{ route('back.juridique.contrats.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header"><h3 class="card-title">Statistiques</h3></div><div class="card-body"><dl><dt>Document lié</dt><dd><a href="{{ route('back.juridique.documents.show', $contrat->document) }}">{{ $contrat->document->titre }}</a></dd><dt>Créé le</dt><dd>{{ $contrat->created_at->format('d/m/Y') }}</dd></dl></div></div></div>
</div>
@endsection