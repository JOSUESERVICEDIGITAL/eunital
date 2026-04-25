@extends('back.layouts.principal')

@section('title', 'Modifier indicateur')
@section('page_title', 'Modifier indicateur')
@section('page_subtitle', $indicateur->nom)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.indicateurs.update', $indicateur) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.indicateurs._form', ['indicateur' => $indicateur])
    </form>
</div>

@include('back.innovations.indicateurs._styles')
@endsection
