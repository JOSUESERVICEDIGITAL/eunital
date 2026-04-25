@extends('back.layouts.principal')

@section('title', 'Nouvel impact')
@section('page_title', 'Nouvel impact')
@section('page_subtitle', 'Créer une mesure d’impact pour une innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.impacts.store') }}">
        @csrf
        @include('back.innovations.impacts._form', ['impact' => null])
    </form>
</div>

@include('back.innovations.impacts._styles')
@endsection
