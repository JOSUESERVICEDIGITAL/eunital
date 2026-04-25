@extends('back.layouts.principal')

@section('title', 'Nouvelle action')
@section('page_title', 'Nouvelle action')
@section('page_subtitle', 'Créer une action rattachée à une réforme.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.actions.store') }}">
        @csrf
        @include('back.innovations.actions._form', ['action' => null])
    </form>
</div>

@include('back.innovations.actions._styles')
@endsection
