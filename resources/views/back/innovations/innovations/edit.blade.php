@extends('back.layouts.principal')

@section('title', 'Modifier innovation')
@section('page_title', 'Modifier innovation')
@section('page_subtitle', $innovation->titre)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.innovations.update', $innovation) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.innovations._form', ['innovation' => $innovation])
    </form>
</div>

@include('back.innovations.innovations._styles')
@endsection
