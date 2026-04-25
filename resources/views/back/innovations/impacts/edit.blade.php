@extends('back.layouts.principal')

@section('title', 'Modifier impact')
@section('page_title', 'Modifier impact')
@section('page_subtitle', $impact->type_impact)

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.impacts.update', $impact) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.impacts._form', ['impact' => $impact])
    </form>
</div>

@include('back.innovations.impacts._styles')
@endsection
