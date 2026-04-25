@extends('back.layouts.principal')

@section('title', 'Modifier objectif')
@section('page_title', 'Modifier objectif')
@section('page_subtitle', $objectif->titre)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.objectifs.update', $objectif) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.objectifs._form', ['objectif' => $objectif])
    </form>
</div>

@include('back.innovations.objectifs._styles')
@endsection
