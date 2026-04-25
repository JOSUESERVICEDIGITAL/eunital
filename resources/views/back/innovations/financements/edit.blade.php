@extends('back.layouts.principal')

@section('title', 'Modifier financement')
@section('page_title', 'Modifier financement')
@section('page_subtitle', $financement->source_financement)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.financements.update', $financement) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.financements._form', ['financement' => $financement])
    </form>
</div>

@include('back.innovations.financements._styles')
@endsection
