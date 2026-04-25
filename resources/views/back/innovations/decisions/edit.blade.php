@extends('back.layouts.principal')

@section('title', 'Modifier décision')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.decisions.update',$decision) }}">
        @csrf
        @method('PUT')
        @include('back.innovations.decisions._form',['decision'=>$decision])
    </form>
</div>

@include('back.innovations.decisions._styles')
@endsection
