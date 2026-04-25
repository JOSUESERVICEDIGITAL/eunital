@extends('back.layouts.principal')

@section('title', 'Nouvelle réforme')
@section('page_title', 'Nouvelle réforme')
@section('page_subtitle', 'Créer un chantier de transformation ou modernisation interne.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.reformes.store') }}">
        @csrf
        @include('back.innovations.reformes._form', ['reforme' => null])
    </form>
</div>

@include('back.innovations.reformes._styles')
@endsection
