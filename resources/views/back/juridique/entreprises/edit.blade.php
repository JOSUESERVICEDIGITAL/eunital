@extends('back.juridique.layouts.app')
@section('title', 'Modifier entreprise')
@section('page_title', 'Modification')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-edit"></i> Modifier</h3></div>
            <form action="{{ route('back.juridique.entreprises.update', $entreprise) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">@include('back.juridique.entreprises.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Mettre à jour</button><a href="{{ route('back.juridique.entreprises.show', $entreprise) }}" class="btn btn-info">Voir</a><a href="{{ route('back.juridique.entreprises.index') }}" class="btn btn-secondary">Retour</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header">Statistiques</div><div class="card-body"><dl><dt>Documents</dt><dd>{{ $entreprise->documents_count ?? 0 }}</dd><dt>Contrats</dt><dd>{{ $entreprise->contrats_count ?? 0 }}</dd></dl></div></div></div>
</div>
@endsection