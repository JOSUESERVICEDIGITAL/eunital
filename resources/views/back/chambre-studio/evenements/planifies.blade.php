@extends('back.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h4>📌 Événements planifiés</h4>
        <small class="text-muted">Événements à venir ou en attente de réalisation</small>
    </div>

    @include('back.chambre-studio.evenements._liste-table', ['evenements' => $evenements])
</div>
@endsection