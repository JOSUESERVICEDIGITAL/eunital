@extends('back.layouts.principal')

@section('title', 'Nouvelle décision')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.decisions.store') }}">
        @csrf
        @include('back.innovations.decisions._form',['decision'=>null])
    </form>
</div>

@include('back.innovations.decisions._styles')
@endsection
