@extends('back.layouts.principal')

@section('title', 'Nouvelle innovation')
@section('page_title', 'Nouvelle innovation')
@section('page_subtitle', 'Créer une innovation dans la chambre rénovation & innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.innovations.store') }}">
        @csrf
        @include('back.innovations.innovations._form', ['innovation' => null])
    </form>
</div>

@include('back.innovations.innovations._styles')
@endsection
