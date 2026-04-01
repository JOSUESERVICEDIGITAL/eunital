@extends('back.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h4>❌ Événements annulés</h4>
        <small class="text-muted">Événements annulés ou reportés</small>
    </div>

    @include('back.chambre-studio.evenements._liste-table', ['evenements' => $evenements])
</div>
@endsection