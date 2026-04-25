@extends('back.layouts.principal')

@section('title', 'Modifier action')
@section('page_title', 'Modifier action')
@section('page_subtitle', $action->titre)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.actions.update', $action) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.actions._form', ['action' => $action])
    </form>
</div>

@include('back.innovations.actions._styles')
@endsection
