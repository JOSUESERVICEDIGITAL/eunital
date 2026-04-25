@extends('back.layouts.principal')

@section('title', 'Modifier risque')
@section('page_title', 'Modifier risque')
@section('page_subtitle', $risque->titre)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.risques.update', $risque) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.risques._form', ['risque' => $risque])
    </form>
</div>

@include('back.innovations.risques._styles')
@endsection
