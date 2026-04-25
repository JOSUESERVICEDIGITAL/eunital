@extends('back.layouts.principal')

@section('title', 'Nouveau financement')
@section('page_title', 'Nouveau financement')
@section('page_subtitle', 'Ajouter une source de financement pour une innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.financements.store') }}">
        @csrf
        @include('back.innovations.financements._form', ['financement' => null])
    </form>
</div>

@include('back.innovations.financements._styles')
@endsection
