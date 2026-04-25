@extends('back.layouts.principal')

@section('title','Nouveau document')

@section('content')
<div class="content-card">
    <form method="POST" enctype="multipart/form-data"
          action="{{ route('back.innovations.documents.store') }}">
        @csrf
        @include('back.innovations.documents._form',['document'=>null])
    </form>
</div>

@include('back.innovations.documents._styles')
@endsection
