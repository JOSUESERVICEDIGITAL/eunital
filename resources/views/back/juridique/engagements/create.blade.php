@extends('back.juridique.layouts.app')
@section('title', 'Nouvel engagement')
@section('page_title', 'Créer un engagement')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-plus-circle"></i> Informations</h3></div>
            <form action="{{ route('back.juridique.engagements.store') }}" method="POST">
                @csrf
                <div class="card-body">@include('back.juridique.engagements.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button><a href="{{ route('back.juridique.engagements.index') }}" class="btn btn-secondary">Annuler</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header"><h3 class="card-title">Informations</h3></div><div class="card-body"><p>Un engagement représente une charte, un code de conduite ou une déclaration d'engagement.</p><div class="alert alert-info">Les engagements publics sont visibles sur le site.</div></div></div></div>
</div>
@endsection