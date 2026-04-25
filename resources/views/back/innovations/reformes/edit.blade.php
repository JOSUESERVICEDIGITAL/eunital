@extends('back.layouts.principal')

@section('title', 'Modifier réforme')
@section('page_title', 'Modifier réforme')
@section('page_subtitle', $reforme->titre)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.reformes.update', $reforme) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.reformes._form', ['reforme' => $reforme])
    </form>
</div>

@include('back.innovations.reformes._styles')
@endsection
