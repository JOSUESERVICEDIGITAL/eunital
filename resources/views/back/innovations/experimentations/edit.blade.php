@extends('back.layouts.principal')

@section('title', 'Modifier expérimentation')
@section('page_title', 'Modifier expérimentation')
@section('page_subtitle', $experimentation->titre)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.experimentations.update', $experimentation) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.experimentations._form', ['experimentation' => $experimentation])
    </form>
</div>

@include('back.innovations.experimentations._styles')
@endsection
