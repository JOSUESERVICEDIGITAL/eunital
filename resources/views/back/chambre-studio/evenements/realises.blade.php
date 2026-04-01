@extends('back.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h4>✅ Événements réalisés</h4>
        <small class="text-muted">Historique des événements déjà exécutés</small>
    </div>

    @include('back.chambre-studio.evenements._liste-table', ['evenements' => $evenements])
</div>
@endsection