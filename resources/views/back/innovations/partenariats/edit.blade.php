@extends('back.layouts.principal')

@section('title', 'Modifier partenariat')
@section('page_title', 'Modifier partenariat')
@section('page_subtitle', $partenariat->nom_partenaire ?? $partenariat->nom ?? 'Partenariat')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.partenariats.update', $partenariat) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.partenariats._form', ['partenariat' => $partenariat])
    </form>
</div>

@include('back.innovations.partenariats._styles')
@endsection
