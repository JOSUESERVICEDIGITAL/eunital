@extends('back.layouts.principal')

@section('title', 'Nouveau comité')
@section('page_title', 'Nouveau comité')
@section('page_subtitle', 'Créer une instance de gouvernance innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.comites.store') }}">
        @csrf
        @include('back.innovations.comites._form', ['comite' => null])
    </form>
</div>

@include('back.innovations.comites._styles')
@endsection
