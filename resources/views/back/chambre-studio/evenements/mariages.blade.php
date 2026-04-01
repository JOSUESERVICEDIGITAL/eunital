@extends('back.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h4>💍 Mariages</h4>
        <small class="text-muted">Gestion des mariages et cérémonies associées</small>
    </div>

    @include('back.chambre-studio.evenements._liste-table', ['evenements' => $evenements])
</div>
@endsection