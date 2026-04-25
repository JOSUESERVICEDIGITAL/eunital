@extends('back.layouts.principal')

@section('title', 'Modifier comité')
@section('page_title', 'Modifier comité')
@section('page_subtitle', $comite->nom)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.comites.update', $comite) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.comites._form', ['comite' => $comite])
    </form>
</div>

@include('back.innovations.comites._styles')
@endsection
