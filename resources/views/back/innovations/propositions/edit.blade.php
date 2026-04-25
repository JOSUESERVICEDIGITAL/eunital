@extends('back.layouts.principal')

@section('title','Modifier proposition')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.propositions.update',$proposition) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.propositions._form',['proposition'=>$proposition])
    </form>
</div>

@include('back.innovations.propositions._styles')
@endsection
