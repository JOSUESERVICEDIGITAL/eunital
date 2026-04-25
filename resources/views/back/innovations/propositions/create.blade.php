@extends('back.layouts.principal')

@section('title','Nouvelle proposition')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.propositions.store') }}">
        @csrf
        @include('back.innovations.propositions._form',['proposition'=>null])
    </form>
</div>

@include('back.innovations.propositions._styles')
@endsection
