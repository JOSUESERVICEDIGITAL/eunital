@extends('back.juridique.layouts.app')
@section('title', 'Notification')
@section('page_title', 'Détails')
@section('juridique-content')
<div class="card"><div class="card-header">{{ $notification->message }}</div><div class="card-body"><p>Date: {{ $notification->created_at->format('d/m/Y H:i:s') }}</p>@if($notification->data)<pre>{{ json_encode($notification->data, JSON_PRETTY_PRINT) }}</pre>@endif</div><div class="card-footer"><a href="{{ route('back.juridique.notifications.index') }}" class="btn btn-secondary">Retour</a></div></div>
@endsection