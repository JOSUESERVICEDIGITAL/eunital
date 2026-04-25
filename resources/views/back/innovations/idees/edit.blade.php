@extends('back.layouts.principal')

@section('title', 'Modifier idée')
@section('page_title', 'Modifier idée')
@section('page_subtitle', $idee->titre)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.idees.update', $idee) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.idees._form', ['idee' => $idee])
    </form>
</div>

@include('back.innovations.idees._styles')
@endsection
