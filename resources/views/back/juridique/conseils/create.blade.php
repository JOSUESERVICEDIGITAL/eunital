@extends('back.juridique.layouts.app')
@section('title', 'Nouveau conseil')
@section('page_title', 'Créer un conseil juridique')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Informations</h3></div>
            <form action="{{ route('back.juridique.conseils.store') }}" method="POST">
                @csrf
                <div class="card-body">@include('back.juridique.conseils.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="{{ route('back.juridique.conseils.index') }}" class="btn btn-secondary">Annuler</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header">Informations</div><div class="card-body"><p>Les conseils juridiques sont des articles d'aide pour les utilisateurs.</p><div class="alert alert-info">Les conseils publiés sont visibles sur le site public.</div></div></div></div>
</div>
@endsection