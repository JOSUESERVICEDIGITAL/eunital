@extends('back.layouts.principal')

@section('title', 'Nouveau partenariat')
@section('page_title', 'Nouveau partenariat')
@section('page_subtitle', 'Ajouter un partenaire à une innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.partenariats.store') }}">
        @csrf
        @include('back.innovations.partenariats._form', ['partenariat' => null])
    </form>
</div>

@include('back.innovations.partenariats._styles')
@endsection
