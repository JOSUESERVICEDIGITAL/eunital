@extends('back.layouts.principal')

@section('title','Nouveau déploiement')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.deploiements.store') }}">
        @csrf
        @include('back.innovations.deploiements._form',['deploiement'=>null])
    </form>
</div>

@include('back.innovations.deploiements._styles')
@endsection
