@extends('back.layouts.principal')

@section('title', 'Nouvelle expérimentation')
@section('page_title', 'Nouvelle expérimentation')
@section('page_subtitle', 'Créer un test terrain pour une innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.experimentations.store') }}">
        @csrf
        @include('back.innovations.experimentations._form', ['experimentation' => null])
    </form>
</div>

@include('back.innovations.experimentations._styles')
@endsection
