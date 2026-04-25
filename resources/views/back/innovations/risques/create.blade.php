@extends('back.layouts.principal')

@section('title', 'Nouveau risque')
@section('page_title', 'Nouveau risque')
@section('page_subtitle', 'Créer un risque rattaché à une réforme.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.risques.store') }}">
        @csrf
        @include('back.innovations.risques._form', ['risque' => null])
    </form>
</div>

@include('back.innovations.risques._styles')
@endsection