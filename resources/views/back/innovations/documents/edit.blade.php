@extends('back.layouts.principal')

@section('title','Modifier document')

@section('content')
<div class="content-card">
    <form method="POST" enctype="multipart/form-data"
          action="{{ route('back.innovations.documents.update',$document) }}">
        @csrf
        @method('PUT')

        @include('back.innovations.documents._form',['document'=>$document])
    </form>
</div>

@include('back.innovations.documents._styles')
@endsection
