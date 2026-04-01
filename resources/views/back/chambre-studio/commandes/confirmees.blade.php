@extends('back.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h4>✅ Commandes confirmées</h4>
        <small class="text-muted">Commandes validées prêtes pour traitement</small>
    </div>

    @include('back.chambre-studio.commandes._liste-table', ['commandes' => $commandes])
</div>
@endsection