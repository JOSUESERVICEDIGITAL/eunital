@extends('back.layouts.principal')

@section('title', 'Modifier suivi')
@section('page_title', 'Modifier suivi')
@section('page_subtitle', optional($suivi->innovation)->titre ?? 'Innovation')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.suivis.update', $suivi) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.suivis._form', ['suivi' => $suivi])
    </form>
</div>

@include('back.innovations.suivis._styles')
@endsection
