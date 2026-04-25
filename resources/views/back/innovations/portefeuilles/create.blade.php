@extends('back.layouts.principal')

@section('title', 'Nouveau portefeuille')
@section('page_title', 'Nouveau portefeuille')
@section('page_subtitle', 'Créer un portefeuille stratégique pour organiser les initiatives.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.portefeuilles.store') }}">
        @csrf
        @include('back.innovations.portefeuilles._form', ['portefeuille' => null])
    </form>
</div>

@include('back.innovations.portefeuilles._styles')
@endsection
