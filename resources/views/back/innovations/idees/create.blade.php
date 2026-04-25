@extends('back.layouts.principal')

@section('title', 'Nouvelle idée')
@section('page_title', 'Nouvelle idée')
@section('page_subtitle', 'Ajouter une idée dans la boîte à innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.idees.store') }}">
        @csrf
        @include('back.innovations.idees._form', ['idee' => null])
    </form>
</div>

@include('back.innovations.idees._styles')
@endsection
