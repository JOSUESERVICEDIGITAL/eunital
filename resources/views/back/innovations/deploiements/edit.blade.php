@extends('back.layouts.principal')

@section('title','Modifier déploiement')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.deploiements.update',$deploiement) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.deploiements._form',['deploiement'=>$deploiement])
    </form>
</div>

@include('back.innovations.deploiements._styles')
@endsection
