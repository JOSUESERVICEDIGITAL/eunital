@extends('back.layouts.principal')

@section('title', 'Modifier portefeuille')
@section('page_title', 'Modifier portefeuille')
@section('page_subtitle', $portefeuille->nom)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.portefeuilles.update', $portefeuille) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.portefeuilles._form', ['portefeuille' => $portefeuille])
    </form>
</div>

@include('back.innovations.portefeuilles._styles')
@endsection
