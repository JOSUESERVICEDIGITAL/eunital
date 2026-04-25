@extends('back.layouts.principal')

@section('title', 'Nouvel objectif')
@section('page_title', 'Nouvel objectif')
@section('page_subtitle', 'Créer un objectif rattaché à une innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.objectifs.store') }}">
        @csrf
        @include('back.innovations.objectifs._form', ['objectif' => null])
    </form>
</div>

@include('back.innovations.objectifs._styles')
@endsection
