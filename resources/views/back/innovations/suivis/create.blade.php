@extends('back.layouts.principal')

@section('title', 'Nouveau suivi')
@section('page_title', 'Nouveau suivi')
@section('page_subtitle', 'Créer un point de suivi pour une innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.suivis.store') }}">
        @csrf
        @include('back.innovations.suivis._form', ['suivi' => null])
    </form>
</div>

@include('back.innovations.suivis._styles')
@endsection
