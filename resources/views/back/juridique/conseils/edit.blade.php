@extends('back.juridique.layouts.app')
@section('title', 'Modifier conseil')
@section('page_title', 'Modification')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Modifier</h3></div>
            <form action="{{ route('back.juridique.conseils.update', $conseilJuridique) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">@include('back.juridique.conseils.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Mettre à jour</button><a href="{{ route('back.juridique.conseils.show', $conseilJuridique) }}" class="btn btn-info">Voir</a><a href="{{ route('back.juridique.conseils.index') }}" class="btn btn-secondary">Retour</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header">Statistiques</div><div class="card-body"><dl><dt>Vues</dt><dd>{{ $conseilJuridique->vues }}</dd><dt>Créé le</dt><dd>{{ $conseilJuridique->created_at->format('d/m/Y') }}</dd></dl></div></div></div>
</div>
@endsection